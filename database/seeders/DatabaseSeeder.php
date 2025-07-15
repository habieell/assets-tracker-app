<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // (Opsional) Buat user admin jika memang masih digunakan untuk login Filament
        User::factory()->create([
            'name' => 'Admin ICG',
            'email' => 'admin@indoconsult.com',
            'password' => bcrypt('pass123'),
        ]);

        // Generate 100 data asset tanpa user_id
        Asset::factory()->count(50)->create();
    }
}