<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'pickup_location',
        'delivery_location',
        'type_of_goods',
        'date',
        'weight_dimensions',
        'message',
    ];
}
