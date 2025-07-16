<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trucking;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Mail\TruckingCreated;
use App\Mail\TruckingDelivered;

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

        $truckings = $query->orderBy('created_at', 'desc')->paginate(5);
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
        $tracking_number = strtoupper(Str::random(5));

        // Create trucking order
        $trucking = Trucking::create(array_merge($request->all(), ['tracking_number' => $tracking_number]));

        // Send Email Notification
        Mail::to($trucking->email)->send(new TruckingCreated($trucking));

        // Send SMS Notification
        $this->sendSms($trucking->phone, "Dear {$trucking->name}, Your order {$tracking_number} has been successfully received and is being processed. You will receive an update once it reaches your destination. You can track your order at www.motorspeedcourier.com/order-tracking");

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
            Mail::to($trucking->email)->send(new TruckingDelivered($trucking));

            // Send SMS Notification
            $this->sendSms($trucking->phone, "Dear {$trucking->name}, Your order {$trucking->tracking_number} has been successfully delivered. We appreciate your trust in MOTORSPEED LOGISTICS! Inquiry: 0711-222-666");
        }

        return redirect()->route('admin.trucking.index')->with('success', 'Status updated successfully!');
    }

    public function destroy(Trucking $trucking)
    {
        $trucking->delete();
        return redirect()->route('admin.trucking.index')->with('success', 'Trucking order deleted successfully!');
    }

    // Updated trackOrder method to handle both Trucking and Order models
    public function trackOrder(Request $request)
    {
        $trackingNumber = $request->input('tracking_number');
        $trucking = null;
        $order = null;
        $trackingType = null;

        if ($trackingNumber) {
            // First, try to find in Trucking model
            $trucking = Trucking::where('tracking_number', $trackingNumber)->first();

            // If not found in Trucking, try Order model
            if (!$trucking) {
                $order = Order::where('tracking_number', $trackingNumber)
                    ->with(['client', 'statusHistory'])
                    ->first();

                if ($order) {
                    $trackingType = 'order';
                }
            } else {
                $trackingType = 'trucking';
            }
        }

        if ($request->ajax()) {
            $response = [
                'trucking' => $trucking,
                'order' => $order ? $order->load(['client', 'statusHistory']) : null,
                'trackingType' => $trackingType,
                'trackingNumber' => $trackingNumber,
            ];

            // Add computed attributes for order if it exists
            if ($order) {
                $response['order']['status_label'] = $order->status_label;
                $response['order']['status_color'] = $order->status_color;
            }

            return response()->json($response);
        }

        return view('order-tracking', compact('trucking', 'order', 'trackingType', 'trackingNumber'));
    }

    private function sendSms($phoneNumber, $message)
    {
        $appKey = '403a1d6847b47b7a3dbe998d511b186c';
        $appToken = '12756';
        $apiUrl = 'https://sms.textsms.co.ke/api/services/sendsms/';

        // Normalize phone number
        $phoneNumber = $this->normalizePhoneNumber($phoneNumber);

        try {
            $response = Http::post($apiUrl, [
                'apikey' => $appKey,
                'partnerID' => $appToken,
                'message' => $message,
                'shortcode' => 'MOTORSPEED',
                'mobile' => $phoneNumber,
            ]);

            if ($response->successful()) {
                Log::info("SMS sent successfully to $phoneNumber.");
            } else {
                Log::error("Failed to send SMS to $phoneNumber. Response: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("Error sending SMS: " . $e->getMessage());
        }
    }

    private function normalizePhoneNumber($number)
    {
        // Remove all non-digit characters
        $number = preg_replace('/\D/', '', $number);

        // Ensure it starts with country code (e.g., 254 for Kenya)
        if (!str_starts_with($number, '254')) {
            $number = '254' . ltrim($number, '0');
        }

        return $number;
    }
}
