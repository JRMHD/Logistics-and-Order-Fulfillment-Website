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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_frozen')->default(false)->after('role');
            $table->timestamp('last_seen')->nullable()->after('is_frozen');
            $table->boolean('api_authorized')->default(false)->after('last_seen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_frozen', 'last_seen', 'api_authorized']);
        });
    }
};
