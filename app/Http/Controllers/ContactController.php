<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'email'      => 'required|email',
            'message'    => 'required|string|max:1000',
        ]);

        //  Save to DB
        Contact::create($validated);

        //  Send email
        $adminEmail = 'farouksameh105@gmail.com'; //email that will receive the contact messages
        Mail::to($adminEmail)->send(new ContactMail($validated));

        //  Redirect with message
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
