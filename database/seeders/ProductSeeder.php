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
        $products = [
            [
                'name' => 'Kopi Hitam',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC001',
            ],
            [
                'name' => 'Gula Pasir',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC002',
            ],
            [
                'name' => 'Roti Tawar',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC003',
            ],
            [
                'name' => 'Selai Coklat',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC004',
            ],
            [
                'name' => 'Teh Celup',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC005',
            ],
            [
                'name' => 'Susu Kental Manis',
                'price' => rand(5000, 20000),
                'stock' => 100,
                'barcode' => 'BC006',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['barcode' => $product['barcode']],
                $product + ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}