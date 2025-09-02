<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityDistance extends Model
{
    protected $fillable = [
        'origin_city_id',
        'destination_city_id',
        'distance_km',
        'duration_minutes',
        'method',
        'last_updated'
    ];

    protected $casts = [
        'distance_km' => 'decimal:2',
        'duration_minutes' => 'integer',
        'last_updated' => 'datetime'
    ];

    public function originCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'origin_city_id');
    }

    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }

    /**
     * Create or update distance between two cities
     */
    public static function setDistance(City $origin, City $destination, float $distance, string $method = 'manual'): self
    {
        return self::updateOrCreate([
            'origin_city_id' => $origin->id,
            'destination_city_id' => $destination->id,
        ], [
            'distance_km' => $distance,
            'method' => $method,
            'last_updated' => now()
        ]);
    }

    /**
     * Find distance between two cities (bidirectional)
     */
    public static function findDistance(City $origin, City $destination): ?float
    {
        // Direct route
        $distance = self::where('origin_city_id', $origin->id)
            ->where('destination_city_id', $destination->id)
            ->first();

        if ($distance) {
            return $distance->distance_km;
        }

        // Reverse route
        $distance = self::where('origin_city_id', $destination->id)
            ->where('destination_city_id', $origin->id)
            ->first();

        return $distance ? $distance->distance_km : null;
    }
}