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
            $table->decimal('distance_km', 8, 2)->nullable()->after('delivery_type');
            $table->decimal('base_shipping_rate', 8, 2)->nullable()->after('distance_km');
            $table->decimal('weight_charge', 8, 2)->nullable()->after('base_shipping_rate');
            $table->decimal('distance_charge', 8, 2)->nullable()->after('weight_charge');
            $table->decimal('delivery_type_multiplier', 3, 2)->default(1.0)->after('distance_charge');
            $table->decimal('total_shipping_cost', 8, 2)->nullable()->after('delivery_type_multiplier');
            $table->string('rate_calculation_method')->nullable()->after('total_shipping_cost'); // 'google_maps', 'fallback', 'estimate'
            $table->boolean('is_within_nairobi')->default(false)->after('rate_calculation_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'distance_km',
                'base_shipping_rate',
                'weight_charge',
                'distance_charge',
                'delivery_type_multiplier',
                'total_shipping_cost',
                'rate_calculation_method',
                'is_within_nairobi'
            ]);
        });
    }
};
