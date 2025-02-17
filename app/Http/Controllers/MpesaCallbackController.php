<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaCallbackController extends Controller
{
    public function handleCallback(Request $request)
    {
        // Log the callback data
        Log::info('M-Pesa Callback:', $request->all());

        // Process the callback (e.g., update payment status in the database)
        // Example:
        // if (isset($request->Body['stkCallback']['ResultCode']) && $request->Body['stkCallback']['ResultCode'] == '0') {
        //     // Payment was successful
        // } else {
        //     // Payment failed
        // }

        return response()->json(['success' => true]);
    }
}
