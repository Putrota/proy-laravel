<?php

namespace App\Listeners;

use Mail;
use App\Events\MessageWasReceibed;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAutoresponder implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageWasReceibed  $event
     * @return void
     */
    public function handle(MessageWasReceibed $event)
    {

        $message = $event->message;

        if( auth()->check() ) {

            $message->email = auth()->user()->email;

        }

        // Cache::flush();
        
        Mail::send('emails.contact', ['msg' => $message], function($m) use ($message){
            $m->to($message->email, $message->nombre)->subject('Tu mensaje fue recibido');
        });

    }


}
