<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|max:35',
            'email' => 'required|email',
            'phone' => 'nullable|numeric|digits:10',
            'message' => 'required|max:255'
        ]);

        Contact::create($data);
        
        return redirect(url()->previous().'#contact')->with('success', 'Your email has been sent!');
    }
}
