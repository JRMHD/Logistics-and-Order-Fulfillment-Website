<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trucking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\TruckingCreated;

class TruckingController extends Controller
{
    public function index(Request $request)
    {
        $query = Trucking::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('tracking_number', 'LIKE', "%{$search}%");
        }

        $truckings = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.trucking.index', compact('truckings'));
    }

    public function create()
    {
        return view('admin.trucking.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'load_description' => 'required|string',
            'status' => 'required|in:Pending,In Transit,Delivered,Cancelled',
        ]);

        // Generate tracking number
        $tracking_number = strtoupper(Str::random(10));

        // Create trucking order
        $trucking = Trucking::create(array_merge($request->all(), ['tracking_number' => $tracking_number]));

        // Send Email Notification
        Mail::to($trucking->email)->send(new TruckingCreated($trucking));

        // Send SMS Notification
        $this->sendSms($trucking->phone, "Hello {$trucking->name}, your trucking order has been created successfully. Your Tracking Number is: {$tracking_number}.");

        return redirect()->route('admin.trucking.index')->with('success', 'Trucking order added successfully! Tracking Number: ' . $tracking_number);
    }

    public function show(Trucking $trucking)
    {
        return view('admin.trucking.show', compact('trucking'));
    }

    public function edit(Trucking $trucking)
    {
        return view('admin.trucking.edit', compact('trucking'));
    }

    public function update(Request $request, Trucking $trucking)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Transit,Delivered,Cancelled',
        ]);

        $trucking->update($request->all());

        // Send email notification when status is updated to Delivered
        if ($request->status == 'Delivered') {
            Mail::to($trucking->email)->send(new \App\Mail\TruckingDelivered($trucking));
        }

        // Send SMS Notification if status updated to Delivered
        if ($request->status == 'Delivered') {
            $this->sendSms($trucking->phone, "Good news {$trucking->name}! Your trucking order ({$trucking->tracking_number}) has been delivered successfully.");
        }

        return redirect()->route('admin.trucking.index')->with('success', 'Status updated successfully!');
    }

    public function destroy(Trucking $trucking)
    {
        $trucking->delete();
        return redirect()->route('admin.trucking.index')->with('success', 'Trucking order deleted successfully!');
    }

    public function trackOrder(Request $request)
    {
        $trackingNumber = $request->input('tracking_number');
        $trucking = Trucking::where('tracking_number', $trackingNumber)->first();

        if ($request->ajax()) {
            return response()->json([
                'trucking' => $trucking,
                'trackingNumber' => $trackingNumber,
            ]);
        }

        return view('order-tracking', compact('trucking', 'trackingNumber'));
    }

    /**
     * Send SMS using the API
     */
    private function sendSms($phone, $message)
    {
        // Normalize phone number
        $phoneNumber = $this->normalizePhoneNumber($phone);

        $appKey = env('SMS_APP_KEY');
        $appToken = env('SMS_APP_TOKEN');
        $apiUrl = 'https://sms.textsms.co.ke/api/services/sendsms/';

        try {
            $response = Http::post($apiUrl, [
                'apikey' => $appKey,
                'partnerID' => $appToken,
                'message' => $message,
                'shortcode' => 'TextSMS',
                'mobile' => $phoneNumber,
            ]);

            $success = $response->successful();

            return $success;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Normalize phone number
     */
    private function normalizePhoneNumber($number)
    {
        $number = preg_replace('/\D/', '', $number);

        if (!str_starts_with($number, '254')) {
            $number = '254' . ltrim($number, '0');
        }

        return $number;
    }
}
