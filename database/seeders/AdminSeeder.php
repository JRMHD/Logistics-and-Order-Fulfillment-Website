<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'nyamsawa@gmail.com'],
            [
                'name' => 'Edwin Otieno',
                'email' => 'nyamsawa@gmail.com',
                'password' => Hash::make('@Edwin2065'),
                'is_admin' => true,
            ]
        );
    }
}
