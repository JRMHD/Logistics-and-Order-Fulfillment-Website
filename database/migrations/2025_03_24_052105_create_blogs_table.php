<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('author');
            $table->enum('category', [
                'Freight & Shipping',
                'Warehousing',
                'Supply Chain Management',
                'Last-Mile Delivery',
                'Technology in Logistics',
                'Order Fulfilment',
                'Reverse Logistic',
                'Other'
            ]);
            $table->text('content');
            $table->text('keywords')->nullable();
            $table->text('seo_tags')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
