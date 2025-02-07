<?php

namespace App\Http\Controllers;

use App\Mail\QuoteRequestNotification;
use App\Mail\QuoteRequestConfirmation;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'pickup_location' => 'required|string|max:255',
            'delivery_location' => 'required|string|max:255',
            'type_of_goods' => 'required|string|max:255',
            'date' => 'required|date',
            'weight_dimensions' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $quote = QuoteRequest::create($request->all());

        // Send Emails
        Mail::to('nyamsawa@gmail.com')->send(new QuoteRequestNotification($quote));
        // Mail::to($request->input('phone'))->send(new QuoteRequestConfirmation($quote));

        return response()->json(['success' => 'Your request has been submitted successfully!'], 200);
    }
}
