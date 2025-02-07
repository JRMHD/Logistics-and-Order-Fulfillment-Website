<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($request->all());

        Mail::send(new ContactFormMail($contact));

        return response()->json(['message' => 'Your message has been sent successfully!'], 200);
    }
}
