<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Laptop;
use Illuminate\Support\Str;

class LaptopSecondSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Master Data Brand (jika belum ada)
        $brands = ['ASUS', 'Lenovo', 'Apple', 'HP', 'Dell'];
        foreach ($brands as $bName) {
            Brand::firstOrCreate(['name' => $bName], ['slug' => Str::slug($bName)]);
        }

        $asus = Brand::where('name', 'ASUS')->first();
        $lenovo = Brand::where('name', 'Lenovo')->first();
        $apple = Brand::where('name', 'Apple')->first();

        // 2. Buat Sampel Katalog Laptop (Ready Stock)
        $laptops = [
            [
                'brand_id' => $asus->id,
                'title' => 'ASUS ROG Zephyrus G14 Gaming Second Mulus',
                'slug' => 'asus-rog-zephyrus-g14-second',
                'serial_number' => 'SN-ROG998821',
                'processor' => 'AMD Ryzen 9 5900HS',
                'ram' => '16GB DDR4',
                'storage' => '512GB NVMe SSD',
                'gpu' => 'NVIDIA RTX 3060 6GB',
                'buy_price' => 11000000,
                'refurbish_cost' => 150000,
                'price' => 13500000,
                'condition_grade' => 'Grade A+ (98% Mulus)',
                'description' => 'Laptop gaming performa tinggi, ex garansi resmi, mulus tanpa kendala.',
                'battery_health' => 'Health 92% (Excellent)',
                'screen_condition' => 'No Dead Pixel, Mulus',
                'keyboard_status' => 'RGB Normal 100%',
                'status' => 'available'
            ],
            [
                'brand_id' => $lenovo->id,
                'title' => 'Lenovo ThinkPad X1 Carbon Gen 7 Ultrabook',
                'slug' => 'lenovo-thinkpad-x1-carbon-gen-7',
                'serial_number' => 'SN-TPX177332',
                'processor' => 'Intel Core i7-8565U',
                'ram' => '16GB LPDDR3',
                'storage' => '512GB SSD',
                'gpu' => 'Intel UHD Graphics',
                'buy_price' => 5500000,
                'refurbish_cost' => 100000,
                'price' => 6900000,
                'condition_grade' => 'Grade A (95% Standar Pemakaian)',
                'description' => 'Raja ketikan, sangat ringan, bodi karbon kuat dan elegan.',
                'battery_health' => 'Health 88% (Good)',
                'screen_condition' => 'IPS Tajam, Normal',
                'keyboard_status' => 'Backlit Berfungsi Normal',
                'status' => 'available'
            ],
            [
                'brand_id' => $apple->id,
                'title' => 'MacBook Pro 13 M1 2020 Space Grey',
                'slug' => 'macbook-pro-13-m1-2020',
                'serial_number' => 'SN-MBPM12020',
                'processor' => 'Apple M1 Chip',
                'ram' => '8GB Unified',
                'storage' => '256GB SSD',
                'gpu' => 'Apple 7-core GPU',
                'buy_price' => 8500000,
                'refurbish_cost' => 0,
                'price' => 10200000,
                'condition_grade' => 'Grade A+ (Like New)',
                'description' => 'Cycle count rendah, baterai awet berhari-hari, mulus kelengkapan lengkap.',
                'battery_health' => 'Maximum Capacity 94%',
                'screen_condition' => 'Retina Display Clean',
                'keyboard_status' => 'Magic Keyboard Normal',
                'status' => 'available'
            ]
        ];

        foreach ($laptops as $lap) {
            Laptop::firstOrCreate(['serial_number' => $lap['serial_number']], $lap);
        }
    }
}