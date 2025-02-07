<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use App\Mail\QuoteRequestUserMail;
use App\Mail\QuoteRequestOwnerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteRequestController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'pickup_location' => 'required|string',
            'delivery_location' => 'required|string',
            'type_of_goods' => 'required|string',
            'date' => 'required|date',
            'weight_dimensions' => 'required|string',
            'email' => 'required|email'
        ]);

        $quote = QuoteRequest::create($request->all());

        Mail::send(new QuoteRequestUserMail($quote));
        Mail::send(new QuoteRequestOwnerMail($quote));

        return response()->json(['message' => 'Your quote request has been received.'], 200);
    }
}
