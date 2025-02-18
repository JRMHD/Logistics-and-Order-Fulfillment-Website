<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trucking_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trucking_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->string('phone');
            $table->string('merchant_request_id');
            $table->string('checkout_request_id');
            $table->string('status')->default('pending'); // pending, completed, cancelled
            $table->json('response_data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trucking_payments');
    }
};
