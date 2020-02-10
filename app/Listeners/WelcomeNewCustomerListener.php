<?php

namespace App\Listeners;

use App\Events\NewCustomerHasRegisteredEvent;
use App\Mail\WelcomeNewCustomerMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeNewCustomerListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewCustomerHasRegisteredEvent $event)
    {
        sleep(10);
        Mail::to($event->customer->email)->send(new WelcomeNewCustomerMail($event->customer));
    }
}
