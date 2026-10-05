<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laptop extends Model
{
    protected $fillable = [
        'brand_id',
        'title',
        'serial_number',
        'processor',
        'ram',
        'storage',
        'vga',
        'screen_size',
        'condition_grade',
        'description',
        'price',
        'status',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
