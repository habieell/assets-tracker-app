<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'old_location',
        'new_location',
        'action',
        'log_date',
    ];

    protected $casts = [
        'log_date' => 'datetime',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}