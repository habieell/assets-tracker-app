<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        $admin = User::factory()->create([
            'name' => 'Admin ICG',
            'email' => 'admin@indoconsult.com',
            'password' => bcrypt('pass123'),
        ]);

        Asset::factory()->count(100)->create([
            'user_id' => $admin->id,
        ]);
    }
}
