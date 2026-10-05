<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['name', 'slug'];

    public function laptops(): HasMany
    {
        return $this->hasMany(Laptop::class);
    }

    public function laptopOffers(): HasMany
    {
        return $this->hasMany(LaptopOffer::class);
    }
}