<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['code' => 'P001', 'name' => 'Banana Gum - A'],
            ['code' => 'P002', 'name' => 'Banana Gum - B'],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(['code' => $p['code']], $p);
        }
    }
}
