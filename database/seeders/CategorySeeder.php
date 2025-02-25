<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Electronics', 'description' => 'Electronic gadgets and devices']);
        Category::create(['name' => 'Clothing', 'description' => 'Fashion and apparel']);
    }
}
