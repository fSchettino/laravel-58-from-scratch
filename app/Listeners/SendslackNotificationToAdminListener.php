<?php

namespace App\Listeners;

use App\Events\NewCustomerHasRegisteredEvent;

class SendslackNotificationToAdminListener
{
    /**
     * Handle the event.
     *
     * @param  NewCustomerHasRegisteredEvent  $event
     * @return void
     */
    public function handle(NewCustomerHasRegisteredEvent $event)
    {
        dump('Send Slack notification to administrator');
    }
}
