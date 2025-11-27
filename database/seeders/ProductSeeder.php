<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Kopi Hitam',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Gula Pasir',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Roti Tawar',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Selai Coklat',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC004',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Teh Celup',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC005',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Susu Kental Manis',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC006',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}