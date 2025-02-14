<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Mail;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'services' => 'required|string',
            'message' => 'nullable|string',
        ]);

        // Save data to the database
        $quote = QuoteRequest::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'services' => $request->services,
            'message' => $request->message,
        ]);

        // Send email to the owner
        Mail::send('emails.quote_request', ['quote' => $quote], function ($message) use ($quote) {
            $message->to('nyamsawa@gmail.com')
                ->subject('New Quote Request')
                ->from($quote->email);
        });

        // Send confirmation email to the user
        Mail::send('emails.user_confirmation', ['quote' => $quote], function ($message) use ($quote) {
            $message->to($quote->email)
                ->subject('Quote Request Confirmation')
                ->from('info@motorspeedcourier.com');
        });

        return response()->json([
            'success' => true,
            'message' => 'Your request has been submitted successfully.',
        ]);
    }
}
