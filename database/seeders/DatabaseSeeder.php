<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'cashier@example.com'],
            [
                'name' => 'Cashier User',
                'password' => bcrypt('password'),
                'role' => 'cashier',
            ]
        );

        $this->call(ProductSeeder::class);
    }
}
