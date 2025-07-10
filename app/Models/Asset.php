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
        'location',
        'status',
        'input_date',
        'barcode_url',
        'user_id',
        'purchase_date',
        'used_date',
        'description',
    ];

    protected $casts = [
        'input_date' => 'date',
        'purchase_date' => 'date',
        'used_date' => 'date',
    ];

    public function logs()
    {
        return $this->hasMany(AssetLog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}