<?php

namespace App\Listeners;

use Mail;
use App\Events\MessageWasReceibed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationToTheOwner implements ShouldQueue
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
        
        Mail::send('emails.contact', ['msg' => $message], function($m) use ($message){
            $m->from($message->email, $message->nombre)
                ->to('alexis.cabrera@gmail.com', 'Alexis')
                ->subject('Tu mensaje fue recibido');
        });

    }
}
