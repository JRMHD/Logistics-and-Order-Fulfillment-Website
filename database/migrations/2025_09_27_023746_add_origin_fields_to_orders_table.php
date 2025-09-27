<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add origin fields after customer details
            $table->text('origin_address')->nullable()->after('customer_phone');
            $table->string('origin_city')->nullable()->after('origin_address');
            $table->string('origin_state')->nullable()->after('origin_city');
            $table->string('origin_country')->nullable()->after('origin_state');
            $table->string('origin_postal_code')->nullable()->after('origin_country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'origin_address',
                'origin_city',
                'origin_state',
                'origin_country',
                'origin_postal_code'
            ]);
        });
    }
};
