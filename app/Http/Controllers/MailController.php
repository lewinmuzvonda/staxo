<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function confirmationEmail() {

        $user = Auth::user();

        $data = array('client_name'=>$user->name);
        $client_email = $user->email;
        $client_name = $user->name;
        
        Mail::send('customer/email/confirm', $data, function($message) use ($client_email, $client_name) {

           $message->to($client_email, $client_name)->subject('Order Confirmation');
           $message->from('info@lewindev.com','STAXOLEWIN');

        });
    }

    public function cancelledEmail() {

        $user = Auth::user();

        $data = array('client_name'=>$user->name);
        $client_email = $user->email;
        $client_name = $user->name;
        
        Mail::send('customer/email/cancelled', $data, function($message) use ($client_email, $client_name) {

           $message->to($client_email, $client_name)->subject('Order Cancelled');
           $message->from('info@lewindev.com','STAXOLEWIN');

        });
    }

}
