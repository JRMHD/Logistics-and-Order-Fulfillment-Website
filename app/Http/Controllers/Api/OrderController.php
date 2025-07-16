<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Mail\OrderCreatedNotification;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orders = Order::where('client_id', $request->user()->id)
            ->with('statusHistory')
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->tracking_number, function ($query, $tracking) {
                return $query->where('tracking_number', $tracking);
            })
            ->when($request->external_order_id, function ($query, $externalId) {
                return $query->where('external_order_id', $externalId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $orders,
            'message' => 'Orders retrieved successfully'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'external_order_id' => 'nullable|string|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.description' => 'nullable|string',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'special_instructions' => 'nullable|string',
            'cash_on_delivery' => 'boolean',
            'cod_amount' => 'nullable|numeric|min:0',
            'delivery_type' => 'nullable|in:standard,express,same_day',
            'estimated_delivery' => 'nullable|date|after:now',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::create([
            'client_id' => $request->user()->id,
            'external_order_id' => $request->external_order_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'delivery_address' => $request->delivery_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'items' => $request->items,
            'total_amount' => $request->total_amount,
            'currency' => $request->currency ?? 'KES',
            'special_instructions' => $request->special_instructions,
            'cash_on_delivery' => $request->cash_on_delivery ?? false,
            'cod_amount' => $request->cod_amount,
            'delivery_type' => $request->delivery_type ?? 'standard',
            'estimated_delivery' => $request->estimated_delivery,
        ]);

        // Load the order with client relationship for notifications
        $order->load('client');

        // Send email notification to admin
        try {
            Mail::to('nyamsawa1@gmail.com')->send(new OrderCreatedNotification($order));
            Log::info("Admin notification email sent for order: {$order->tracking_number}");
        } catch (\Exception $e) {
            Log::error("Failed to send admin notification email for order {$order->tracking_number}: " . $e->getMessage());
        }

        // Send SMS notifications to admin numbers
        $adminNumbers = ['0798984929', '0706378245'];
        $adminMessage = "NEW ORDER ALERT! Company: {$order->client->company_name}, Customer: {$order->customer_name}, Tracking: {$order->tracking_number}, Amount: {$order->currency} {$order->total_amount}. Check admin panel for details.";

        foreach ($adminNumbers as $number) {
            $this->sendSms($number, $adminMessage);
        }

        return response()->json([
            'success' => true,
            'data' => $order->load('statusHistory'),
            'message' => 'Order created successfully'
        ], 201);
    }

    public function show(Request $request, string $trackingNumber): JsonResponse
    {
        $order = Order::where('tracking_number', $trackingNumber)
            ->where('client_id', $request->user()->id)
            ->with('statusHistory')
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order,
            'message' => 'Order retrieved successfully'
        ]);
    }

    public function update(Request $request, string $trackingNumber): JsonResponse
    {
        $order = Order::where('tracking_number', $trackingNumber)
            ->where('client_id', $request->user()->id)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Only allow updating certain fields
        $validator = Validator::make($request->all(), [
            'external_order_id' => 'nullable|string|max:255',
            'customer_name' => 'string|max:255',
            'customer_email' => 'email|max:255',
            'customer_phone' => 'string|max:20',
            'delivery_address' => 'string',
            'city' => 'string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'special_instructions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $order->update($request->only([
            'external_order_id',
            'customer_name',
            'customer_email',
            'customer_phone',
            'delivery_address',
            'city',
            'state',
            'country',
            'postal_code',
            'special_instructions',
        ]));

        return response()->json([
            'success' => true,
            'data' => $order->fresh(['statusHistory']),
            'message' => 'Order updated successfully'
        ]);
    }

    public function track(Request $request, string $trackingNumber): JsonResponse
    {
        $order = Order::where('tracking_number', $trackingNumber)
            ->where('client_id', $request->user()->id)
            ->with('statusHistory')
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'tracking_number' => $order->tracking_number,
                'status' => $order->status,
                'status_label' => $order->status_label,
                'estimated_delivery' => $order->estimated_delivery,
                'actual_delivery' => $order->actual_delivery,
                'history' => $order->statusHistory->map(function ($history) {
                    return [
                        'status' => $history->status,
                        'status_label' => $history->status_label,
                        'notes' => $history->notes,
                        'location' => $history->location,
                        'timestamp' => $history->created_at,
                    ];
                })
            ],
            'message' => 'Order tracking retrieved successfully'
        ]);
    }

    public function cancel(Request $request, string $trackingNumber): JsonResponse
    {
        $order = Order::where('tracking_number', $trackingNumber)
            ->where('client_id', $request->user()->id)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        if ($order->isDelivered()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot cancel delivered order'
            ], 400);
        }

        if ($order->isCancelled()) {
            return response()->json([
                'success' => false,
                'message' => 'Order is already cancelled'
            ], 400);
        }

        $order->updateStatus(
            Order::STATUS_CANCELLED,
            'Order cancelled by client',
            null,
            $request->user()->id
        );

        return response()->json([
            'success' => true,
            'data' => $order->fresh(['statusHistory']),
            'message' => 'Order cancelled successfully'
        ]);
    }

    public function getStatuses(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Order::getStatusList(),
            'message' => 'Order statuses retrieved successfully'
        ]);
    }

    /**
     * Send SMS notification
     */
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

    /**
     * Normalize phone number format
     */
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
