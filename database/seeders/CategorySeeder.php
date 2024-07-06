<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create four categories
        $categories = Category::factory(4)->create();

        // Create 40 subcategories (10 subcategories for each category)
        $categories->each(function ($category) {
            SubCategory::factory(10)->create(['category_id' => $category->id]);
        });
    }
}
