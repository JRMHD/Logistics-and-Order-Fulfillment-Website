<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cities table
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('normalized_name')->index();
            $table->string('region')->nullable();
            $table->string('country', 3)->default('KEN');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_nairobi_area')->default(false);
            $table->boolean('is_major_city')->default(false);
            $table->json('aliases')->nullable(); // Alternative names
            $table->timestamps();

            $table->index(['country', 'is_major_city']);
            $table->index(['normalized_name', 'country']);
        });

        // City distances table
        Schema::create('city_distances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('destination_city_id')->constrained('cities')->onDelete('cascade');
            $table->decimal('distance_km', 8, 2);
            $table->integer('duration_minutes')->nullable();
            $table->enum('method', ['google_maps', 'manual', 'calculated', 'estimated']);
            $table->timestamp('last_updated')->useCurrent();
            $table->timestamps();

            // Ensure no duplicate routes
            $table->unique(['origin_city_id', 'destination_city_id']);
            $table->index(['origin_city_id', 'distance_km']);
        });

        // Rate zones table (for different pricing zones)
        Schema::create('rate_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., 'Nairobi Metropolitan', 'Coast Region'
            $table->decimal('flat_rate', 8, 2)->nullable();
            $table->decimal('base_rate', 8, 2)->nullable();
            $table->decimal('rate_per_kg', 8, 2)->nullable();
            $table->decimal('rate_per_km', 8, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Zone cities mapping
        Schema::create('zone_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained('rate_zones')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['zone_id', 'city_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('zone_cities');
        Schema::dropIfExists('rate_zones');
        Schema::dropIfExists('city_distances');
        Schema::dropIfExists('cities');
    }
};