<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'client_id',
        'external_order_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'delivery_address',
        'city',
        'state',
        'country',
        'postal_code',
        'items',
        'total_amount',
        'currency',
        'special_instructions',
        'cash_on_delivery',
        'cod_amount',
        'delivery_type',
        'status',
        'estimated_delivery',
        'actual_delivery',
        'delivery_notes',
        'delivered_to',
    ];

    protected $casts = [
        'items' => 'array',
        'total_amount' => 'decimal:2',
        'cod_amount' => 'decimal:2',
        'cash_on_delivery' => 'boolean',
        'estimated_delivery' => 'datetime',
        'actual_delivery' => 'datetime',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_ORDER_RECEIVED = 'order_received';
    const STATUS_PROCESSING = 'processing';
    const STATUS_DISPATCHED = 'dispatched';
    const STATUS_PICKED_UP = 'picked_up';
    const STATUS_IN_TRANSIT = 'in_transit';
    const STATUS_CUSTOMS_CLEARANCE = 'customs_clearance';
    const STATUS_RELEASED_BY_CUSTOMS = 'released_by_customs';
    const STATUS_OUT_FOR_DELIVERY = 'out_for_delivery';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_FAILED_DELIVERY = 'failed_delivery';
    const STATUS_WRONG_ADDRESS = 'wrong_address';
    const STATUS_CONTACT_NOT_AVAILABLE = 'contact_not_available';
    const STATUS_DELAYED_DELIVERY = 'delayed_delivery';
    const STATUS_ITEM_DAMAGED = 'item_damaged';
    const STATUS_RETURNED_TO_SENDER = 'returned_to_sender';
    const STATUS_CANCELLED = 'cancelled';

    public static function getStatusList(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ORDER_RECEIVED => 'Order Received',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_DISPATCHED => 'Dispatched',
            self::STATUS_PICKED_UP => 'Picked Up',
            self::STATUS_IN_TRANSIT => 'In Transit',
            self::STATUS_CUSTOMS_CLEARANCE => 'Customs Clearance',
            self::STATUS_RELEASED_BY_CUSTOMS => 'Released by Customs',
            self::STATUS_OUT_FOR_DELIVERY => 'Out for Delivery',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_FAILED_DELIVERY => 'Failed Delivery',
            self::STATUS_WRONG_ADDRESS => 'Wrong Address',
            self::STATUS_CONTACT_NOT_AVAILABLE => 'Contact Not Available',
            self::STATUS_DELAYED_DELIVERY => 'Delayed Delivery',
            self::STATUS_ITEM_DAMAGED => 'Item Damaged',
            self::STATUS_RETURNED_TO_SENDER => 'Returned to Sender',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    public static function generateTrackingNumber(): string
    {
        return 'LG' . strtoupper(Str::random(8));
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class)->orderBy('created_at', 'desc');
    }

    public function updateStatus(string $status, string $notes = null, string $location = null, int $updatedBy = null): void
    {
        $this->update(['status' => $status]);

        $this->statusHistory()->create([
            'status' => $status,
            'notes' => $notes,
            'location' => $location,
            'updated_by' => $updatedBy,
            'created_at' => now(),
        ]);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::getStatusList()[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_ORDER_RECEIVED => 'info',
            self::STATUS_PROCESSING => 'primary',
            self::STATUS_DISPATCHED => 'primary',
            self::STATUS_PICKED_UP => 'primary',
            self::STATUS_IN_TRANSIT => 'info',
            self::STATUS_CUSTOMS_CLEARANCE => 'warning',
            self::STATUS_RELEASED_BY_CUSTOMS => 'info',
            self::STATUS_OUT_FOR_DELIVERY => 'primary',
            self::STATUS_DELIVERED => 'success',
            self::STATUS_FAILED_DELIVERY => 'danger',
            self::STATUS_WRONG_ADDRESS => 'warning',
            self::STATUS_CONTACT_NOT_AVAILABLE => 'warning',
            self::STATUS_DELAYED_DELIVERY => 'warning',
            self::STATUS_ITEM_DAMAGED => 'danger',
            self::STATUS_RETURNED_TO_SENDER => 'secondary',
            self::STATUS_CANCELLED => 'danger',
            default => 'secondary',
        };
    }

    public function isDelivered(): bool
    {
        return $this->status === self::STATUS_DELIVERED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isInProgress(): bool
    {
        return !in_array($this->status, [
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED,
            self::STATUS_RETURNED_TO_SENDER,
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->tracking_number) {
                $order->tracking_number = self::generateTrackingNumber();
            }
        });

        static::created(function ($order) {
            $order->updateStatus(
                self::STATUS_ORDER_RECEIVED,
                'Order received from ' . $order->client->company_name
            );
        });
    }
}
