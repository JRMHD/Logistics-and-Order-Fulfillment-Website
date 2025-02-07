<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Mail\SubscriptionThankYouMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = Subscriber::create(['email' => $request->email]);

        Mail::send(new SubscriptionThankYouMail($subscriber->email));

        return response()->json(['message' => 'Thank you for subscribing!'], 200);
    }
}
