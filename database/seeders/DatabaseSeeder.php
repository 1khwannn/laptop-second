<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jalankan Seeder Master Data Merek
        $this->call([
            BrandSeeder::class,
        ]);

        // 2. Buat Akun Admin untuk Uji Coba
        User::factory()->create([
            'name' => 'Admin Toko',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 3. Buat Akun Customer / User Biasa
        User::factory()->create([
            'name' => 'Customer Test',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}