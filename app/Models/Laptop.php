<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'title',
        'slug',
        'processor',
        'ram',
        'storage',
        'gpu',
        'price',
        'condition_grade',
        'description',
        'photo',
        'status',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}