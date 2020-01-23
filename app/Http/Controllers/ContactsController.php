<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Show the dealer inspire landing page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('contacts.index');
    }

    /**
     * Validate and store the data from the contact form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|max:35',
            'email' => 'required|email',
            'phone' => 'nullable|numeric|digits:10',
            'message' => 'required|max:255'
        ]);

        // the recipient can be set in the .env file but will also default to a backup email address if the env property isn't set
        $data['recipient_email'] = env("MAIL_TO", "guy-smiley@example.com");

        Contact::create($data);
        
        return redirect(url()->previous().'/#contact')->with('success', 'Your email has been sent!');
    }
}
