<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Sending email using Mail facade
        // We can pass contact form data to ContactFormMail through constructor
        Mail::to('test@test.com')->send(new ContactFormMail($data));

        // Sending a message while redirect (->with() method store data into session array )
        // data flashed into session are used once only, they don't persist into the session.
        //return redirect('contact')->with('message', 'Thanks for your message. We\'ll be in touch');

        // Alternative way of flashing data to session
        session()->flash('message', 'Thanks for your message. We\'ll be in touch');

        return redirect('contact');
    }
}
