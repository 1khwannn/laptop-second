<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category() { return $this->belongsTo(Category::class); } public function orders() { return $this->hasMany(Order::class); }
    protected $fillable = [ 'category_id', 'name', 'brand', 'specs', 'condition', 'price', 'stock', 'image', 'status' ];
}
