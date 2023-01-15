<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Order;
use App\Models\Job;
use App\Models\Transaction;

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

        // $schedule->command('inspire')->hourly();
        // $schedule->call(function () {
            
        // })->daily();

        foreach ($jobs as $job) {
  
            $schedule->call(function() use($job) {
                /*  Run your task here */

                $transaction = Transaction::where('id','=',$job->transaction_id)->first();
                $secondPayment = $transaction->amount;

                if($job->status == 0){

                    $user = Auth::user();

                    $stripeCharge = $user->charge(
                        $secondPayment, $job->paymentMethodId
                    );

                    if($stripeCharge){
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
