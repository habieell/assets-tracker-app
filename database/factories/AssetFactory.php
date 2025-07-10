<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {
        return [
            'code' => 'AST-' . strtoupper(Str::random(6)),
            'name' => $this->faker->word(),
            'location' => $this->faker->city(),
            'status' => $this->faker->randomElement(['aktif', 'rusak', 'dipindah']),
            'input_date' => $this->faker->date(),
            'purchase_date' => $this->faker->date(),
            'used_date' => $this->faker->date(),
            'purchase_price' => $this->faker->randomFloat(2, 100000, 5000000),
            'purchase_source' => $this->faker->company(),
            'invoice_number' => 'INV-' . $this->faker->numerify('###-####'),
            'user_id' => null, // default null, bisa diisi dari Seeder
        ];
    }
}