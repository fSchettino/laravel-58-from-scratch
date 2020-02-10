<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeNewCustomerMail extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @param $customer
     */
    public function __construct($customer)
    {
        //
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-welcome');
    }
}
