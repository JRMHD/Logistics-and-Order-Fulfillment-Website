<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class City extends Model
{
    protected $fillable = [
        'name',
        'normalized_name',
        'region',
        'country',
        'latitude',
        'longitude',
        'is_nairobi_area',
        'is_major_city',
        'aliases'
    ];

    protected $casts = [
        'aliases' => 'array',
        'is_nairobi_area' => 'boolean',
        'is_major_city' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    /**
     * Distances originating from this city
     */
    public function distancesFrom(): HasMany
    {
        return $this->hasMany(CityDistance::class, 'origin_city_id');
    }

    /**
     * Distances going to this city
     */
    public function distancesTo(): HasMany
    {
        return $this->hasMany(CityDistance::class, 'destination_city_id');
    }

    /**
     * Rate zones this city belongs to
     */
    public function rateZones(): BelongsToMany
    {
        return $this->belongsToMany(RateZone::class, 'zone_cities');
    }

    /**
     * Find distance to another city
     */
    public function distanceTo(City $destination): ?float
    {
        // Check direct route
        $distance = $this->distancesFrom()
            ->where('destination_city_id', $destination->id)
            ->first();

        if ($distance) {
            return $distance->distance_km;
        }

        // Check reverse route
        $distance = $this->distancesTo()
            ->where('origin_city_id', $destination->id)
            ->first();

        return $distance ? $distance->distance_km : null;
    }

    /**
     * Find city by name with aliases
     */
    public static function findByName(string $name): ?City
    {
        $normalized = strtolower(trim($name));

        // Direct match
        $city = self::where('normalized_name', $normalized)->first();
        if ($city) return $city;

        // Search in aliases
        return self::whereJsonContains('aliases', $normalized)->first();
    }

    /**
     * Check if both cities are in the same rate zone
     */
    public function sharesSameZoneWith(City $other): bool
    {
        $thisZones = $this->rateZones()->pluck('id')->toArray();
        $otherZones = $other->rateZones()->pluck('id')->toArray();

        return !empty(array_intersect($thisZones, $otherZones));
    }

    /**
     * Get applicable rate zone for route to another city
     */
    public function getRateZoneFor(City $destination): ?RateZone
    {
        // If both cities are in Nairobi area, use Nairobi zone
        if ($this->is_nairobi_area && $destination->is_nairobi_area) {
            return RateZone::where('name', 'Nairobi Metropolitan')->first();
        }

        // Otherwise use nationwide zone
        return RateZone::where('name', 'Nationwide')->first();
    }
}