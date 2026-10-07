<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaptopOffer extends Model
{
    protected $fillable = [
        'user_id',
        'brand_id',
        'model_name',
        'phone_number',
        'processor',
        'ram',
        'storage',
        'condition_description',
        'expected_price',
        'admin_offer_price',
        'status',
        'admin_notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
