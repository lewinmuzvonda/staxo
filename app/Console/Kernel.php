<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Order;
use App\Models\User;
use App\Models\Job;
use App\Models\Transaction;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

         $jobs = Job::all();

        foreach ($jobs as $job) {
  
            $schedule->call(function() use($job) {
                /*  Run your task here */

                $transaction = Transaction::where('id','=',$job->transaction_id)->first();
                $order = Order::where('id','=',$transaction->order_id)->first();
                $client = User::where('id','=',$order->customer_id)->first();

                $secondPayment = (int) $transaction->amount * 100;

                if($job->status == 0){

                    $stripeCharge = $client->charge(
                        $secondPayment, $job->paymentMethodId
                    );

                    if($stripeCharge->status == "succeeded"){

                        Order::where('id',$order->id)->update(['status'=>2]);
                        Transaction::where('id',$transaction->id)->update(['status'=>1]);

                        $mail = new MailController;
                        $mail->settlementEmail($client);
                        
                        Job::where('id','=', $job->id)->delete();

                    }

                }elseif($job->status == 1){

                    Job::where('id','=', $job->id)->delete();

                }

                Log::info($job->transaction_id.' '.\Carbon\Carbon::now());
            })->everyFiveMinutes();;
        }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
