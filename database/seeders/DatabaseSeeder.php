<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@local.dev',
            'password' => Hash::make('admin'),
        ]);
    }
}
