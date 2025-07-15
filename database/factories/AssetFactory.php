<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {
        $divisions = ['IT', 'GA'];
        $categories = ['MOBIL', 'LAPTOP', 'PRINTER', 'AC', 'FURNITURE'];
        $division = $this->faker->randomElement($divisions);
        $category = $this->faker->randomElement($categories);
        $assetNumber = $this->faker->numberBetween(1000, 9999);
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        return [
            'code' => "ICG/{$division}/{$category}/{$assetNumber}/{$month}-{$year}",
            'name' => $this->faker->randomElement([
                'Laptop Lenovo',
                'Printer Epson',
                'Meja Kantor',
                'Kursi Ergonomis',
                'AC Panasonic'
            ]),
            'division_owner' => $division,
            'category' => $category,
            'asset_number' => $assetNumber,
            'penanggung_jawab' => $this->faker->name(),
            'location' => $this->faker->randomElement(['Kantor Pusat', 'Gudang Utama', 'Ruang IT']),
            'status' => $this->faker->randomElement(['aktif', 'rusak', 'dipindah']),
            'input_date' => now(),
            'purchase_date' => $this->faker->date(),
            'used_date' => $this->faker->date(),
            'purchase_price' => $this->faker->randomFloat(2, 500000, 20000000),
            'purchase_source' => $this->faker->company(),
            'invoice_number' => 'INV-' . $this->faker->numerify('###-####'),
            'asset_image' => null,
            'invoice_image' => null,
            'description' => $this->faker->sentence(),
        ];
    }
}
