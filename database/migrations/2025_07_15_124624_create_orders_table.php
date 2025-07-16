<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->string('external_order_id')->nullable();

            // Customer Details
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('delivery_address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('postal_code')->nullable();

            // Order Details
            $table->text('items');
            $table->decimal('total_amount', 10, 2);
            $table->string('currency', 3)->default('KES');
            $table->text('special_instructions')->nullable();

            // Delivery Options
            $table->boolean('cash_on_delivery')->default(false);
            $table->decimal('cod_amount', 10, 2)->nullable();
            $table->string('delivery_type')->default('standard');

            // Status and Tracking
            $table->enum('status', [
                'pending',
                'order_received',
                'processing',
                'dispatched',
                'picked_up',
                'in_transit',
                'customs_clearance',
                'released_by_customs',
                'out_for_delivery',
                'delivered',
                'failed_delivery',
                'wrong_address',
                'contact_not_available',
                'delayed_delivery',
                'item_damaged',
                'returned_to_sender',
                'cancelled'
            ])->default('pending');

            $table->timestamp('estimated_delivery')->nullable();
            $table->timestamp('actual_delivery')->nullable();
            $table->text('delivery_notes')->nullable();
            $table->string('delivered_to')->nullable();

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index(['client_id', 'status']);
            $table->index(['tracking_number']);
            $table->index(['customer_phone']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
