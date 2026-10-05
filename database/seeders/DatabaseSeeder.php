<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['ASUS', 'Lenovo', 'Acer', 'HP', 'Dell', 'Apple / MacBook', 'MSI'];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => \Illuminate\Support\Str::slug($brand),
            ]);
        }
    }
}