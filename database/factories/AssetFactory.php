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
        $categories = ['MOBIL', 'LAPTOP', 'PRINTER', 'AC', 'FURNITURE', 'TV', 'CCTV', 'HANDPHONE'];

        $division = $this->faker->randomElement($divisions);
        $category = $this->faker->randomElement($categories);
        $assetNumber = str_pad($this->faker->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        return [
            'code' => "ICG/{$division}/{$category}/{$assetNumber}/{$month}-{$year}",
            'name' => $this->faker->randomElement([
                'Toyota Alphard',
                'Toyota Avanza',
                'Mobil Xpander Ultimate CVT',
                'Laptop Lenovo',
                'Printer Epson 14150',
                'Kursi Ergonomis',
                'AC Panasonic',
                'Smart TV LED 50 Inch',
                'Iphone 13',
                'HP Samsung A56'
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
            'purchase_price' => $this->faker->randomFloat(2, 1000000, 50000000), // Harga random
            'purchase_source' => $this->faker->company(),
            'invoice_number' => 'INV-' . $this->faker->numerify('###-####'),

            // ✅ Multiple Images (array JSON)
            'asset_images' => json_encode([
                'uploads/assets/sample1.jpg',
                'uploads/assets/sample2.jpg'
            ]),

            'invoice_image' => 'uploads/invoices/sample-invoice.jpg',

            'description' => $this->faker->sentence(10),
        ];
    }
}
