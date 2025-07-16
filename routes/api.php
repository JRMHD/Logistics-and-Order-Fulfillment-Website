<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API v1 routes with API key authentication
Route::prefix('v1')->middleware('api.auth')->group(function () {

    // Order management endpoints
    Route::apiResource('orders', OrderController::class, [
        'except' => ['destroy']
    ])->parameters([
        'orders' => 'trackingNumber'
    ]);

    // Additional order endpoints
    Route::get('orders/{trackingNumber}/track', [OrderController::class, 'track'])->name('api.orders.track');
    Route::delete('orders/{trackingNumber}/cancel', [OrderController::class, 'cancel'])->name('api.orders.cancel');

    // Get available order statuses
    Route::get('statuses', [OrderController::class, 'getStatuses'])->name('api.statuses');

    // Public tracking endpoint (no authentication required for customer tracking)
    Route::get('track/{trackingNumber}', function ($trackingNumber) {
        $order = \App\Models\Order::where('tracking_number', $trackingNumber)
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
                'customer_name' => $order->customer_name,
                'estimated_delivery' => $order->estimated_delivery,
                'actual_delivery' => $order->actual_delivery,
                'delivery_address' => $order->delivery_address,
                'city' => $order->city,
                'country' => $order->country,
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
    })->name('api.public.track');
});

// Webhook endpoints (no authentication for external services)
Route::prefix('webhooks')->group(function () {
    // Example webhook for external integrations
    Route::post('status-update', function (Request $request) {
        // Handle external status updates
        $request->validate([
            'tracking_number' => 'required|string',
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $order = \App\Models\Order::where('tracking_number', $request->tracking_number)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $order->updateStatus(
            $request->status,
            $request->notes,
            $request->location
        );

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    });
});

// API documentation endpoint
Route::get('docs', function () {
    return response()->json([
        'name' => 'Logistics API',
        'version' => '1.0.0',
        'description' => 'API for managing logistics and delivery orders',
        'base_url' => url('/api/v1'),
        'authentication' => [
            'type' => 'API Key',
            'header' => 'X-API-Key',
            'alternative' => 'Authorization: Bearer {api_key}'
        ],
        'endpoints' => [
            'orders' => [
                'GET /orders' => 'List all orders',
                'POST /orders' => 'Create a new order',
                'GET /orders/{tracking_number}' => 'Get order details',
                'PUT /orders/{tracking_number}' => 'Update order details',
                'GET /orders/{tracking_number}/track' => 'Track order status',
                'DELETE /orders/{tracking_number}/cancel' => 'Cancel order',
            ],
            'utilities' => [
                'GET /statuses' => 'Get available order statuses',
                'GET /track/{tracking_number}' => 'Public order tracking (no auth required)',
            ]
        ],
        'order_statuses' => \App\Models\Order::getStatusList(),
        'supported_countries' => ['Kenya', 'Tanzania', 'Uganda'],
        'delivery_types' => ['standard', 'express', 'same_day'],
        'currencies' => ['KES', 'TZS', 'UGX', 'USD'],
    ]);
});
