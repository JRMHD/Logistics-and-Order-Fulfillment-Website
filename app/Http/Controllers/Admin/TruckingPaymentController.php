<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trucking;
use App\Models\TruckingPayment;
use Iankumu\Mpesa\Facades\Mpesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TruckingPaymentController extends Controller
{
    public function showPaymentForm($id)
    {
        $trucking = Trucking::findOrFail($id);
        // Get the latest payment status if any
        $latestPayment = TruckingPayment::where('trucking_id', $id)
            ->latest()
            ->first();

        return view('admin.trucking.payment', compact('trucking', 'latestPayment'));
    }

    public function initiatePayment(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string',
        ]);

        $trucking = Trucking::findOrFail($id);
        $phone = '254' . substr($request->input('phone'), 1);
        $amount = $request->input('amount');

        // Initiate STK Push
        $response = Mpesa::stkpush($phone, $amount, $trucking->id);

        // Decode the response
        $responseData = json_decode((string) $response, true);

        if (isset($responseData['ResponseCode']) && $responseData['ResponseCode'] == '0') {
            // Create payment record
            TruckingPayment::create([
                'trucking_id' => $trucking->id,
                'amount' => $amount,
                'phone' => $phone,
                'merchant_request_id' => $responseData['MerchantRequestID'],
                'checkout_request_id' => $responseData['CheckoutRequestID'],
                'status' => 'pending',
                'response_data' => $responseData
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment request sent successfully to ' . $phone
                ]);
            }

            return redirect()->back()->with('success', 'Payment request sent successfully to ' . $phone);
        } else {
            Log::error('STK Push Failed:', ['response' => $responseData]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send payment request. Please try again.'
                ], 422);
            }

            return redirect()->back()->with('error', 'Failed to send payment request. Please try again.');
        }
    }

    public function callback(Request $request)
    {
        Log::info('M-Pesa Callback:', $request->all());

        $callbackData = $request->all();

        if (isset($callbackData['Body']['stkCallback'])) {
            $stkCallback = $callbackData['Body']['stkCallback'];
            $resultCode = $stkCallback['ResultCode'];
            $checkoutRequestId = $stkCallback['CheckoutRequestID'];

            // Find the payment record
            $payment = TruckingPayment::where('checkout_request_id', $checkoutRequestId)->first();

            if ($payment) {
                if ($resultCode == 0) {
                    $payment->status = 'completed';
                } else {
                    $payment->status = 'cancelled';
                }
                $payment->response_data = array_merge($payment->response_data ?? [], $callbackData);
                $payment->save();
            }
        }

        return response()->json(['ResponseCode' => '0']);
    }

    public function checkStatus($id)
    {
        $payment = TruckingPayment::where('trucking_id', $id)->latest()->first();

        if (!$payment) {
            return response()->json(['status' => 'no_payment']);
        }

        return response()->json([
            'status' => $payment->status,
            'amount' => $payment->amount,
            'phone' => $payment->phone,
            'updated_at' => $payment->updated_at->diffForHumans()
        ]);
    }
}
