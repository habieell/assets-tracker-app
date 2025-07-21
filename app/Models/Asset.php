<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'division_owner',
        'category',
        'asset_number',
        'penanggung_jawab',
        'location',
        'status',
        'input_date',
        'purchase_date',
        'used_date',
        'end_of_life', // ✅ Tambahan
        'purchase_price',
        'purchase_source',
        'invoice_number',
        'asset_images',
        'invoice_image',
        'description',
    ];

    protected $casts = [
        'input_date' => 'date',
        'purchase_date' => 'date',
        'used_date' => 'date',
        'end_of_life' => 'date', // ✅ Tambahan
        'asset_images' => 'array', // ✅ Karena multiple upload (JSON)
    ];

    /**
     * Hook untuk update status otomatis
     */
    protected static function booted()
    {
        static::saving(function ($asset) {
            if ($asset->end_of_life && now()->greaterThan($asset->end_of_life)) {
                $asset->status = 'inventaris';
            }
        });
    }
}