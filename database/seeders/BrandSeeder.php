<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['ASUS', 'Lenovo', 'Apple', 'HP', 'Acer', 'MSI', 'Dell'];

        foreach ($brands as $brand) {
            $slug = Str::slug($brand);

            Brand::updateOrCreate(
                ['slug' => $slug],
                ['name' => $brand]
            );
        }
    }
}
