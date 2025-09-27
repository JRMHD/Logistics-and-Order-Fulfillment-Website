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
            'origin_address' => 'required|string',
            'origin_city' => 'required|string|max:100',
            'origin_state' => 'nullable|string|max:100',
            'origin_country' => 'required|string|max:100',
            'origin_postal_code' => 'nullable|string|max:20',
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

        // Calculate shipping rate
        $totalWeight = collect($request->items)->sum(function ($item) {
            return $item['quantity'] ?? 1; // Use quantity as weight if no weight specified
        });

        $originCity = strtolower(trim($request->origin_city));
        $destinationCity = strtolower(trim($request->city));
        $deliveryType = $request->delivery_type ?? 'standard';

        // Check if delivery is within Nairobi
        $isWithinNairobi = $this->isWithinNairobi($originCity, $destinationCity);

        $calculationMethod = 'estimate';
        $distance = 0;
        $baseRate = 0;
        $weightCharge = 0;
        $distanceCharge = 0;

        if ($isWithinNairobi) {
            $baseRate = 415; // Flat rate for within Nairobi
            $calculationMethod = 'nairobi_flat_rate';
        } else {
            // Try Google Maps first
            $distance = $this->getDistanceFromGoogleMaps($originCity, $destinationCity);
            if ($distance !== null) {
                $calculationMethod = 'google_maps';
            } else {
                // Try fallback matrix
                $distance = $this->getFallbackDistance($originCity, $destinationCity);
                if ($distance !== null) {
                    $calculationMethod = 'fallback';
                } else {
                    // Final fallback - estimate
                    $distance = $this->estimateDistance($originCity, $destinationCity);
                    $calculationMethod = 'estimate';
                }
            }

            // Nationwide calculation: 100 KSH (base) + 10 KSH per kg + 3 KSH per km
            $baseRate = 100;
            $weightCharge = 10 * $totalWeight;
            $distanceCharge = 3 * $distance;
        }

        $subtotal = $baseRate + $weightCharge + $distanceCharge;

        // Apply delivery type multiplier
        $multiplier = match ($deliveryType) {
            'express' => 1.5,
            'same_day' => 2.0,
            default => 1.0
        };

        $totalShippingCost = $subtotal * $multiplier;

        $order = Order::create([
            'client_id' => $request->user()->id,
            'external_order_id' => $request->external_order_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'origin_address' => $request->origin_address,
            'origin_city' => $request->origin_city,
            'origin_state' => $request->origin_state,
            'origin_country' => $request->origin_country,
            'origin_postal_code' => $request->origin_postal_code,
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
            'delivery_type' => $deliveryType,
            'distance_km' => $distance,
            'base_shipping_rate' => $baseRate,
            'weight_charge' => $weightCharge,
            'distance_charge' => $distanceCharge,
            'delivery_type_multiplier' => $multiplier,
            'total_shipping_cost' => $totalShippingCost,
            'rate_calculation_method' => $calculationMethod,
            'is_within_nairobi' => $isWithinNairobi,
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
            'origin_address' => 'string',
            'origin_city' => 'string|max:100',
            'origin_state' => 'nullable|string|max:100',
            'origin_country' => 'string|max:100',
            'origin_postal_code' => 'nullable|string|max:20',
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
            'origin_address',
            'origin_city',
            'origin_state',
            'origin_country',
            'origin_postal_code',
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

    public function calculateRate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'weight' => 'required|numeric|min:0.1|max:1000',
            'origin_city' => 'required|string|max:100',
            'destination_city' => 'required|string|max:100',
            'delivery_type' => 'nullable|in:standard,express,same_day',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $weight = $request->weight;
        $originCity = strtolower(trim($request->origin_city));
        $destinationCity = strtolower(trim($request->destination_city));
        $deliveryType = $request->delivery_type ?? 'standard';

        // Check if delivery is within Nairobi
        $isWithinNairobi = $this->isWithinNairobi($originCity, $destinationCity);

        if ($isWithinNairobi) {
            $baseRate = 415; // Flat rate for within Nairobi
            $distance = 0; // Not needed for within Nairobi
            $calculation = [
                'base_rate' => 415,
                'weight_charge' => 0,
                'distance_charge' => 0,
                'total' => 415
            ];
        } else {
            // Try Google Maps first
            $distance = $this->getDistanceFromGoogleMaps($originCity, $destinationCity);
            if ($distance === null) {
                // Try fallback matrix
                $distance = $this->getFallbackDistance($originCity, $destinationCity);
                if ($distance === null) {
                    // Final fallback - estimate
                    $distance = $this->estimateDistance($originCity, $destinationCity);
                }
            }

            // Nationwide calculation: 100 KSH (base) + 10 KSH per kg + 3 KSH per km
            $baseRate = 100;
            $weightCharge = 10 * $weight;
            $distanceCharge = 3 * $distance;
            $total = $baseRate + $weightCharge + $distanceCharge;

            $calculation = [
                'base_rate' => $baseRate,
                'weight_charge' => $weightCharge,
                'distance_charge' => $distanceCharge,
                'total' => $total
            ];
        }

        // Apply delivery type multipliers if needed
        $multiplier = match ($deliveryType) {
            'express' => 1.5,
            'same_day' => 2.0,
            default => 1.0
        };

        $finalRate = $calculation['total'] * $multiplier;

        return response()->json([
            'success' => true,
            'data' => [
                'weight' => $weight,
                'origin_city' => $request->origin_city,
                'destination_city' => $request->destination_city,
                'distance_km' => $distance,
                'is_within_nairobi' => $isWithinNairobi,
                'delivery_type' => $deliveryType,
                'calculation_breakdown' => $calculation,
                'delivery_type_multiplier' => $multiplier,
                'total_rate' => round($finalRate, 2),
                'currency' => 'KES'
            ],
            'message' => 'Shipping rate calculated successfully'
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

    /**
     * Check if delivery is within Nairobi
     */
    private function isWithinNairobi($originCity, $destinationCity): bool
    {
        $nairobiAreas = [
            'nairobi',
            'nairobi city',
            'cbd',
            'westlands',
            'karen',
            'langata',
            'kasarani',
            'embakasi',
            'dagoretti',
            'kibra',
            'mathare',
            'starehe',
            'kamukunji',
            'makadara',
            'njiru',
            'ruaraka',
            'roysambu',
            'githurai',
            'thika road',
            'ngong road',
            'mombasa road',
            'uhuru highway',
            'kiambu road',
            'waiyaki way'
        ];

        return in_array($originCity, $nairobiAreas) && in_array($destinationCity, $nairobiAreas);
    }

    /**
     * Calculate distance between two cities in Kenya using Google Maps API with fallback
     */
    private function calculateDistance($originCity, $destinationCity): ?float
    {
        // Normalize city names
        $originCity = $this->normalizeCityName($originCity);
        $destinationCity = $this->normalizeCityName($destinationCity);

        // Same city
        if ($originCity === $destinationCity) {
            return 5; // Default intra-city distance
        }

        // Try Google Maps API first
        $googleDistance = $this->getDistanceFromGoogleMaps($originCity, $destinationCity);
        if ($googleDistance !== null) {
            return $googleDistance;
        }

        // Fallback to hardcoded distance matrix
        $fallbackDistance = $this->getFallbackDistance($originCity, $destinationCity);
        if ($fallbackDistance !== null) {
            return $fallbackDistance;
        }

        // Final fallback - estimate based on city types
        return $this->estimateDistance($originCity, $destinationCity);
    }

    /**
     * Get distance from Google Maps API
     */
    private function getDistanceFromGoogleMaps($origin, $destination): ?float
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        if (!$apiKey) {
            return null;
        }

        try {
            $response = Http::timeout(10)->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins' => $origin . ', Kenya',
                'destinations' => $destination . ', Kenya',
                'units' => 'metric',
                'mode' => 'driving',
                'key' => $apiKey
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (
                    $data['status'] === 'OK' &&
                    isset($data['rows'][0]['elements'][0]) &&
                    $data['rows'][0]['elements'][0]['status'] === 'OK'
                ) {
                    $distanceMeters = $data['rows'][0]['elements'][0]['distance']['value'];
                    $distanceKm = round($distanceMeters / 1000, 1);

                    Log::info("Google Maps distance: {$origin} to {$destination} = {$distanceKm}km");
                    return $distanceKm;
                }
            }
        } catch (\Exception $e) {
            Log::warning("Google Maps API failed: " . $e->getMessage());
        }

        return null;
    }

    /**
     * Get distance from fallback matrix
     */
    private function getFallbackDistance($originCity, $destinationCity): ?float
    {
        // Distance matrix for major Kenyan cities (in kilometers)
        $distances = [
            'nairobi' => [
                'mombasa' => 485,
                'kisumu' => 350,
                'nakuru' => 160,
                'eldoret' => 310,
                'thika' => 42,
                'nyeri' => 150,
                'meru' => 230,
                'machakos' => 64,
                'kitui' => 180,
                'garissa' => 365,
                'kakamega' => 385,
                'kericho' => 260,
                'embu' => 120,
                'kiambu' => 25,
                'murang\'a' => 85,
            ],
            'mombasa' => [
                'nairobi' => 485,
                'malindi' => 120,
                'lamu' => 240,
                'garissa' => 385,
                'kitui' => 320,
                'machakos' => 410,
            ],
            'kisumu' => [
                'nairobi' => 350,
                'eldoret' => 210,
                'kakamega' => 52,
                'nakuru' => 190,
                'kericho' => 85,
            ],
            'nakuru' => [
                'nairobi' => 160,
                'eldoret' => 165,
                'kisumu' => 190,
            ]
        ];

        // Check direct route
        if (isset($distances[$originCity][$destinationCity])) {
            return (float) $distances[$originCity][$destinationCity];
        }

        // Check reverse route
        if (isset($distances[$destinationCity][$originCity])) {
            return (float) $distances[$destinationCity][$originCity];
        }

        return null;
    }

    /**
     * Normalize city name for distance calculation
     */
    private function normalizeCityName($cityName): string
    {
        $cityName = strtolower(trim($cityName));

        // Handle common variations
        $aliases = [
            'nairobi city' => 'nairobi',
            'mombasa city' => 'mombasa',
            'eldoret town' => 'eldoret',
            'nakuru town' => 'nakuru',
            'kisumu city' => 'kisumu',
            'thika town' => 'thika',
            'cbd' => 'nairobi',
            'westlands' => 'nairobi',
            'karen' => 'nairobi',
        ];

        return $aliases[$cityName] ?? $cityName;
    }

    /**
     * Estimate distance for cities not in the matrix
     */
    private function estimateDistance($originCity, $destinationCity): ?float
    {
        // Default estimates for unknown routes
        $defaultEstimates = [
            'short_distance' => 50,   // For nearby towns
            'medium_distance' => 150, // For regional distances
            'long_distance' => 300,   // For cross-country
        ];

        // Basic estimation logic (can be enhanced with actual geo-coordinates)
        $majorCities = ['nairobi', 'mombasa', 'kisumu', 'nakuru', 'eldoret'];

        if (in_array($originCity, $majorCities) || in_array($destinationCity, $majorCities)) {
            return $defaultEstimates['medium_distance'];
        }

        return $defaultEstimates['short_distance'];
    }
}
