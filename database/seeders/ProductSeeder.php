<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'PAN',
            'barcode' => '754545455855',
            'alert' => 10,
            'image' => 'pan.png',
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'FIDEO',
            'barcode' => '754545455855',
            'alert' => 10,
            'image' => 'pan.png',
            'category_id' => 1
        ]);
    }
}
