<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckingPayment extends Model
{
    protected $fillable = [
        'trucking_id',
        'amount',
        'phone',
        'merchant_request_id',
        'checkout_request_id',
        'status',
        'response_data'
    ];

    protected $casts = [
        'response_data' => 'array'
    ];

    public function trucking()
    {
        return $this->belongsTo(Trucking::class);
    }
}
