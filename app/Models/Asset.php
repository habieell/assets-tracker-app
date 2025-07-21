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
        'asset_images' => 'array', 
    ];
}