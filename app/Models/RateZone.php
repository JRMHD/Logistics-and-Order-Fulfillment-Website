<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RateZone extends Model
{
    protected $fillable = [
        'name',
        'flat_rate',
        'base_rate',
        'rate_per_kg',
        'rate_per_km',
        'is_active'
    ];

    protected $casts = [
        'flat_rate' => 'decimal:2',
        'base_rate' => 'decimal:2',
        'rate_per_kg' => 'decimal:2',
        'rate_per_km' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Cities in this rate zone
     */
    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'zone_cities');
    }

    /**
     * Calculate rate for this zone
     */
    public function calculateRate(float $weight, float $distance = 0, string $deliveryType = 'standard'): array
    {
        // Flat rate zone (like Nairobi)
        if ($this->flat_rate) {
            $total = $this->flat_rate;
        } else {
            // Formula-based rate (like nationwide)
            $total = ($this->base_rate ?? 0) + 
                    (($this->rate_per_kg ?? 0) * $weight) + 
                    (($this->rate_per_km ?? 0) * $distance);
        }

        // Apply delivery type multiplier
        $multiplier = match($deliveryType) {
            'express' => 1.5,
            'same_day' => 2.0,
            default => 1.0
        };

        return [
            'base_calculation' => $total,
            'multiplier' => $multiplier,
            'final_rate' => round($total * $multiplier, 2),
            'zone_name' => $this->name
        ];
    }

    /**
     * Get active rate zones
     */
    public static function active()
    {
        return self::where('is_active', true);
    }
}