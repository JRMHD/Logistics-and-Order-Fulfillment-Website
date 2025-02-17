<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trucking;
use Iankumu\Mpesa\Facades\Mpesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TruckingPaymentController extends Controller
{
    public function showPaymentForm($id)
    {
        $trucking = Trucking::findOrFail($id);
        return view('admin.trucking.payment', compact('trucking'));
    }

    public function initiatePayment(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string',
        ]);

        $trucking = Trucking::findOrFail($id);
        $phone = '254' . substr($request->input('phone'), 1); // Convert phone number to 254 format
        $amount = $request->input('amount');

        // Initiate STK Push using the iankumu/mpesa package
        $response = Mpesa::stkpush($phone, $amount, $trucking->id);

        // Check if the request was successful
        if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
            // Log the response
            Log::info('STK Push Response:', $response);

            return redirect()->back()->with('success', 'Payment request sent successfully to ' . $phone);
        } else {
            // Log the error
            Log::error('STK Push Failed:', ['response' => $response]);

            return redirect()->back()->with('error', 'Failed to send payment request. Please check the logs for details.');
        }
    }
}
