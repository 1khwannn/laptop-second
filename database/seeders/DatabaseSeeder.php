<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['ASUS', 'Lenovo', 'Acer', 'HP', 'Dell', 'Apple / MacBook', 'MSI'];

        foreach ($brands as $brand) {
            // Menggunakan firstOrCreate agar tidak error jika data sudah ada
            Brand::firstOrCreate(
                ['slug' => Str::slug($brand)],
                ['name' => $brand]
            );
        }

        $this->call([
            LaptopSecondSeeder::class,
        ]);
    }
}