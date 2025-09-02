<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DistanceCalculatorService
{
    private $googleMapsApiKey;
    private $fallbackDistances;

    public function __construct()
    {
        $this->googleMapsApiKey = config('services.google_maps.api_key');

        // Fallback distance matrix for when Google Maps fails
        $this->fallbackDistances = [
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
            ],
            // ... more fallback data
        ];
    }

    /**
     * Calculate distance between two cities using multiple methods
     */
    public function calculateDistance(string $origin, string $destination): ?float
    {
        $origin = $this->normalizeCity($origin);
        $destination = $this->normalizeCity($destination);

        // Same city
        if ($origin === $destination) {
            return 5; // Default intra-city distance
        }

        // Try cache first (24-hour cache)
        $cacheKey = "distance:{$origin}:{$destination}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Try Google Maps API
        if ($this->googleMapsApiKey) {
            $distance = $this->getDistanceFromGoogleMaps($origin, $destination);
            if ($distance !== null) {
                Cache::put($cacheKey, $distance, 86400); // Cache for 24 hours
                return $distance;
            }
        }

        // Fallback to hardcoded matrix
        $distance = $this->getDistanceFromFallback($origin, $destination);
        if ($distance !== null) {
            Cache::put($cacheKey, $distance, 86400);
            return $distance;
        }

        // Final fallback - estimate
        return $this->estimateDistance($origin, $destination);
    }

    /**
     * Get distance from Google Maps Distance Matrix API
     */
    private function getDistanceFromGoogleMaps(string $origin, string $destination): ?float
    {
        try {
            $response = Http::timeout(10)->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins' => $origin . ', Kenya',
                'destinations' => $destination . ', Kenya',
                'units' => 'metric',
                'mode' => 'driving',
                'key' => $this->googleMapsApiKey
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
    private function getDistanceFromFallback(string $origin, string $destination): ?float
    {
        // Check direct route
        if (isset($this->fallbackDistances[$origin][$destination])) {
            return (float) $this->fallbackDistances[$origin][$destination];
        }

        // Check reverse route
        if (isset($this->fallbackDistances[$destination][$origin])) {
            return (float) $this->fallbackDistances[$destination][$origin];
        }

        return null;
    }

    /**
     * Estimate distance for unknown routes
     */
    private function estimateDistance(string $origin, string $destination): float
    {
        $majorCities = ['nairobi', 'mombasa', 'kisumu', 'nakuru', 'eldoret'];

        // If either city is major, use medium distance
        if (in_array($origin, $majorCities) || in_array($destination, $majorCities)) {
            return 150; // Medium distance estimate
        }

        return 80; // Short distance estimate
    }

    /**
     * Check if route is within Nairobi metropolitan area
     */
    public function isWithinNairobi(string $origin, string $destination): bool
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
            'waiyaki way',
            'upperhill',
            'kilimani',
            'lavington',
            'runda',
            'muthaiga',
            'parklands',
            'eastleigh',
            'south c',
            'south b'
        ];

        $normalizedOrigin = $this->normalizeCity($origin);
        $normalizedDestination = $this->normalizeCity($destination);

        return in_array($normalizedOrigin, $nairobiAreas) &&
            in_array($normalizedDestination, $nairobiAreas);
    }

    /**
     * Normalize city names for consistency
     */
    private function normalizeCity(string $city): string
    {
        $city = strtolower(trim($city));

        $aliases = [
            'nairobi city' => 'nairobi',
            'nairobi cbd' => 'nairobi',
            'mombasa city' => 'mombasa',
            'eldoret town' => 'eldoret',
            'nakuru town' => 'nakuru',
            'kisumu city' => 'kisumu',
            'thika town' => 'thika',
            'nyeri town' => 'nyeri',
            'meru town' => 'meru',
        ];

        return $aliases[$city] ?? $city;
    }

    /**
     * Get comprehensive city data with coordinates (for future use)
     */
    public function getCityData(): array
    {
        return [
            'nairobi' => ['lat' => -1.2921, 'lng' => 36.8219],
            'mombasa' => ['lat' => -4.0435, 'lng' => 39.6682],
            'kisumu' => ['lat' => -0.1022, 'lng' => 34.7617],
            'nakuru' => ['lat' => -0.3031, 'lng' => 36.0800],
            'eldoret' => ['lat' => 0.5143, 'lng' => 35.2698],
            'thika' => ['lat' => -1.0332, 'lng' => 37.0694],
            'nyeri' => ['lat' => -0.4167, 'lng' => 36.9500],
            'meru' => ['lat' => 0.0467, 'lng' => 37.6500],
            'machakos' => ['lat' => -1.5177, 'lng' => 37.2634],
            'kitui' => ['lat' => -1.3667, 'lng' => 38.0167],
        ];
    }
}
