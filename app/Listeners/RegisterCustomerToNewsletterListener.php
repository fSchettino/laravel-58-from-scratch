<?php

namespace App\Listeners;

use App\Events\NewCustomerHasRegisteredEvent;

class RegisterCustomerToNewsletterListener
{
    /**
     * Handle the event.
     *
     * @param  NewCustomerHasRegisteredEvent  $event
     * @return void
     */
    public function handle(NewCustomerHasRegisteredEvent $event)
    {
        dump('Register customer to newsletter');
    }
}
