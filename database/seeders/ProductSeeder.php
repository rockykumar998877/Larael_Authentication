<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create(['name' => 'Smartphone', 'price' => 699.99, 'category_id' => 1]);
        Product::create(['name' => 'T-shirt', 'price' => 19.99, 'category_id' => 2]);
    }
}

