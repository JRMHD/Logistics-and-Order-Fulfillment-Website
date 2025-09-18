<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CityController;

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
    
    // Calculate shipping rates
    Route::post('calculate-rate', [OrderController::class, 'calculateRate'])->name('api.calculate-rate');

    // Cities and locations endpoints
    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('api.cities.index');
        Route::get('/major', [CityController::class, 'major'])->name('api.cities.major');
        Route::get('/nairobi-areas', [CityController::class, 'nairobiAreas'])->name('api.cities.nairobi-areas');
        Route::get('/regions', [CityController::class, 'regions'])->name('api.cities.regions');
        Route::get('/search', [CityController::class, 'search'])->name('api.cities.search');
        Route::get('/countries', [CityController::class, 'countries'])->name('api.cities.countries');
        Route::get('/{identifier}', [CityController::class, 'show'])->name('api.cities.show');
    });

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

// Public endpoints (no authentication required)
Route::prefix('public')->group(function () {
    // Public cities endpoints for dropdown population
    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('api.public.cities.index');
        Route::get('/major', [CityController::class, 'major'])->name('api.public.cities.major');
        Route::get('/nairobi-areas', [CityController::class, 'nairobiAreas'])->name('api.public.cities.nairobi-areas');
        Route::get('/regions', [CityController::class, 'regions'])->name('api.public.cities.regions');
        Route::get('/search', [CityController::class, 'search'])->name('api.public.cities.search');
        Route::get('/countries', [CityController::class, 'countries'])->name('api.public.cities.countries');
        Route::get('/{identifier}', [CityController::class, 'show'])->name('api.public.cities.show');
    });
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
            'cities' => [
                'GET /cities' => 'Get all cities with filtering options',
                'GET /cities/major' => 'Get major cities for dropdowns',
                'GET /cities/nairobi-areas' => 'Get Nairobi metropolitan areas',
                'GET /cities/regions' => 'Get available regions',
                'GET /cities/search' => 'Search cities with autocomplete',
                'GET /cities/countries' => 'Get supported countries',
                'GET /cities/{id}' => 'Get specific city details',
            ],
            'utilities' => [
                'GET /statuses' => 'Get available order statuses',
                'POST /calculate-rate' => 'Calculate shipping rate for checkout',
                'GET /track/{tracking_number}' => 'Public order tracking (no auth required)',
            ]
        ],
        'cities_api' => [
            'description' => 'Comprehensive cities and locations API for dropdown population and address validation',
            'endpoints' => [
                'GET /api/v1/cities' => [
                    'description' => 'Get all cities with optional filtering',
                    'parameters' => [
                        'country' => 'optional|string (KEN, TZS, UGA) - defaults to KEN',
                        'major_only' => 'optional|boolean - filter major cities only',
                        'nairobi_areas' => 'optional|boolean - filter Nairobi areas only',
                        'search' => 'optional|string - search by name',
                        'region' => 'optional|string - filter by region'
                    ],
                    'example' => '/api/v1/cities?country=KEN&major_only=true'
                ],
                'GET /api/v1/cities/major' => [
                    'description' => 'Get major cities optimized for dropdown menus',
                    'parameters' => [
                        'country' => 'optional|string (KEN, TZS, UGA) - defaults to KEN'
                    ],
                    'use_case' => 'Perfect for shipping origin/destination dropdowns'
                ],
                'GET /api/v1/cities/nairobi-areas' => [
                    'description' => 'Get all Nairobi metropolitan areas',
                    'use_case' => 'For detailed Nairobi delivery area selection'
                ],
                'GET /api/v1/cities/search' => [
                    'description' => 'Search cities with autocomplete functionality',
                    'parameters' => [
                        'q' => 'required|string|min:2 - search query',
                        'country' => 'optional|string (KEN, TZS, UGA)',
                        'limit' => 'optional|integer|max:50 - default 10'
                    ],
                    'use_case' => 'For real-time search and autocomplete features'
                ]
            ],
            'response_format' => [
                'success' => true,
                'data' => [
                    'id' => 'integer',
                    'name' => 'string - display name',
                    'normalized_name' => 'string - for API calls',
                    'region' => 'string - county/region',
                    'country' => 'string - country code',
                    'country_name' => 'string - country name',
                    'latitude' => 'decimal - GPS coordinates',
                    'longitude' => 'decimal - GPS coordinates',
                    'is_major_city' => 'boolean',
                    'is_nairobi_area' => 'boolean',
                    'aliases' => 'array - alternative names'
                ],
                'message' => 'string'
            ]
        ],
        'rate_calculation' => [
            'endpoint' => 'POST /api/v1/calculate-rate',
            'description' => 'Calculate shipping rates based on weight, origin, and destination',
            'parameters' => [
                'weight' => 'required|numeric (kg)',
                'origin_city' => 'required|string',
                'destination_city' => 'required|string', 
                'delivery_type' => 'optional|string (standard, express, same_day)'
            ],
            'pricing_rules' => [
                'within_nairobi' => 'Flat rate of 415 KSH regardless of weight',
                'nationwide' => 'Base 100 KSH + (10 KSH × weight) + (3 KSH × distance)',
                'delivery_multipliers' => [
                    'standard' => '1.0x',
                    'express' => '1.5x', 
                    'same_day' => '2.0x'
                ]
            ]
        ],
        'order_statuses' => \App\Models\Order::getStatusList(),
        'supported_countries' => ['Kenya', 'Tanzania', 'Uganda'],
        'delivery_types' => ['standard', 'express', 'same_day'],
        'currencies' => ['KES', 'TZS', 'UGX', 'USD'],
    ]);
});
