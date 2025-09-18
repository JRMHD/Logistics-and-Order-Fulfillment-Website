<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Get list of cities with optional filtering
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'country' => 'nullable|string|in:KEN,TZS,UGA',
            'major_only' => 'nullable|boolean',
            'nairobi_areas' => 'nullable|boolean',
            'search' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $query = City::query();

        // Filter by country
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        } else {
            // Default to Kenya if no country specified
            $query->where('country', 'KEN');
        }

        // Filter major cities only
        if ($request->boolean('major_only')) {
            $query->where('is_major_city', true);
        }

        // Filter Nairobi areas only
        if ($request->boolean('nairobi_areas')) {
            $query->where('is_nairobi_area', true);
        }

        // Search by name
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('normalized_name', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhereJsonContains('aliases', $search);
            });
        }

        // Filter by region
        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        $cities = $query->orderBy('is_major_city', 'desc')
                       ->orderBy('name')
                       ->get()
                       ->map(function ($city) {
                           return [
                               'id' => $city->id,
                               'name' => $city->name,
                               'normalized_name' => $city->normalized_name,
                               'region' => $city->region,
                               'country' => $city->country,
                               'country_name' => $this->getCountryName($city->country),
                               'latitude' => $city->latitude,
                               'longitude' => $city->longitude,
                               'is_major_city' => $city->is_major_city,
                               'is_nairobi_area' => $city->is_nairobi_area,
                               'aliases' => $city->aliases ?? [],
                           ];
                       });

        return response()->json([
            'success' => true,
            'data' => $cities,
            'meta' => [
                'total' => $cities->count(),
                'filters_applied' => array_filter([
                    'country' => $request->country,
                    'major_only' => $request->boolean('major_only'),
                    'nairobi_areas' => $request->boolean('nairobi_areas'),
                    'search' => $request->search,
                    'region' => $request->region,
                ])
            ],
            'message' => 'Cities retrieved successfully'
        ]);
    }

    /**
     * Get a specific city by ID or name
     */
    public function show(Request $request, $identifier): JsonResponse
    {
        // Try to find by ID first
        if (is_numeric($identifier)) {
            $city = City::find($identifier);
        } else {
            // Find by name or normalized name
            $city = City::findByName($identifier);
        }

        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'City not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $city->id,
                'name' => $city->name,
                'normalized_name' => $city->normalized_name,
                'region' => $city->region,
                'country' => $city->country,
                'country_name' => $this->getCountryName($city->country),
                'latitude' => $city->latitude,
                'longitude' => $city->longitude,
                'is_major_city' => $city->is_major_city,
                'is_nairobi_area' => $city->is_nairobi_area,
                'aliases' => $city->aliases ?? [],
                'rate_zones' => $city->rateZones->map(function ($zone) {
                    return [
                        'id' => $zone->id,
                        'name' => $zone->name,
                        'flat_rate' => $zone->flat_rate,
                    ];
                }),
            ],
            'message' => 'City retrieved successfully'
        ]);
    }

    /**
     * Get major cities for quick dropdown
     */
    public function major(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'country' => 'nullable|string|in:KEN,TZS,UGA',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $query = City::where('is_major_city', true);

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        } else {
            $query->where('country', 'KEN');
        }

        $cities = $query->orderBy('name')
                       ->get(['id', 'name', 'normalized_name', 'region', 'country'])
                       ->map(function ($city) {
                           return [
                               'id' => $city->id,
                               'name' => $city->name,
                               'value' => $city->normalized_name, // For form values
                               'region' => $city->region,
                               'country' => $city->country,
                           ];
                       });

        return response()->json([
            'success' => true,
            'data' => $cities,
            'message' => 'Major cities retrieved successfully'
        ]);
    }

    /**
     * Get Nairobi areas for specific metropolitan dropdown
     */
    public function nairobiAreas(): JsonResponse
    {
        $areas = City::where('is_nairobi_area', true)
                    ->where('country', 'KEN')
                    ->orderBy('name')
                    ->get(['id', 'name', 'normalized_name'])
                    ->map(function ($city) {
                        return [
                            'id' => $city->id,
                            'name' => $city->name,
                            'value' => $city->normalized_name,
                        ];
                    });

        return response()->json([
            'success' => true,
            'data' => $areas,
            'message' => 'Nairobi areas retrieved successfully'
        ]);
    }

    /**
     * Get available regions
     */
    public function regions(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'country' => 'nullable|string|in:KEN,TZS,UGA',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $query = City::select('region')
                    ->whereNotNull('region')
                    ->distinct();

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        } else {
            $query->where('country', 'KEN');
        }

        $regions = $query->orderBy('region')
                        ->pluck('region')
                        ->values();

        return response()->json([
            'success' => true,
            'data' => $regions,
            'message' => 'Regions retrieved successfully'
        ]);
    }

    /**
     * Search cities with autocomplete functionality
     */
    public function search(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required|string|min:2|max:100',
            'country' => 'nullable|string|in:KEN,TZS,UGA',
            'limit' => 'nullable|integer|min:1|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $search = strtolower(trim($request->q));
        $limit = $request->get('limit', 10);

        $query = City::where(function ($q) use ($search) {
                    $q->where('normalized_name', 'like', "{$search}%")
                      ->orWhere('name', 'like', "{$search}%")
                      ->orWhereJsonContains('aliases', $search);
                });

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        } else {
            $query->where('country', 'KEN');
        }

        $cities = $query->orderBy('is_major_city', 'desc')
                       ->orderBy('name')
                       ->limit($limit)
                       ->get(['id', 'name', 'normalized_name', 'region', 'is_major_city'])
                       ->map(function ($city) {
                           return [
                               'id' => $city->id,
                               'name' => $city->name,
                               'value' => $city->normalized_name,
                               'region' => $city->region,
                               'is_major_city' => $city->is_major_city,
                               'label' => $city->region ? "{$city->name}, {$city->region}" : $city->name,
                           ];
                       });

        return response()->json([
            'success' => true,
            'data' => $cities,
            'meta' => [
                'query' => $request->q,
                'results_count' => $cities->count(),
                'limit' => $limit,
            ],
            'message' => 'Search results retrieved successfully'
        ]);
    }

    /**
     * Get supported countries
     */
    public function countries(): JsonResponse
    {
        $countries = [
            [
                'code' => 'KEN',
                'name' => 'Kenya',
                'cities_count' => City::where('country', 'KEN')->count()
            ],
            [
                'code' => 'TZS',
                'name' => 'Tanzania',
                'cities_count' => City::where('country', 'TZS')->count()
            ],
            [
                'code' => 'UGA',
                'name' => 'Uganda',
                'cities_count' => City::where('country', 'UGA')->count()
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $countries,
            'message' => 'Supported countries retrieved successfully'
        ]);
    }

    /**
     * Get country name from code
     */
    private function getCountryName(string $code): string
    {
        return match($code) {
            'KEN' => 'Kenya',
            'TZS' => 'Tanzania',
            'UGA' => 'Uganda',
            default => $code
        };
    }
}