<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@example.ir',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
        ]);

        \App\Models\User::factory(5)->create();
    }
}
