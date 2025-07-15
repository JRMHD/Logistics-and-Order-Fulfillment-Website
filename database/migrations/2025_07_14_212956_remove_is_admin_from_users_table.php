<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, migrate existing is_admin data to role column (if role column exists)
        if (Schema::hasColumn('users', 'role')) {
            // Update users with is_admin = true to have role = 'admin'
            DB::table('users')->where('is_admin', true)->update(['role' => 'admin']);
            
            // Update users with is_admin = false to have role = 'user'
            DB::table('users')->where('is_admin', false)->update(['role' => 'user']);
        }

        // Now remove the is_admin column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('role');
        });

        // Restore is_admin data from role column
        DB::table('users')->where('role', 'admin')->update(['is_admin' => true]);
        DB::table('users')->where('role', '!=', 'admin')->update(['is_admin' => false]);
    }
};