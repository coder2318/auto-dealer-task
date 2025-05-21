<?php

namespace Database\Seeders;

use App\Models\V1\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Mercedes-Benz',
                'price_from' => 60000,
                'price_to' => 100000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BMW',
                'price_from' => 40000,
                'price_to' => 120000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'AUDI',
                'price_from' => 50000,
                'price_to' => 125000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rolls-Royce',
                'price_from' => 130000,
                'price_to' => 300000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Brand::query()->truncate();
        Brand::query()->insert($data);
    }
}
