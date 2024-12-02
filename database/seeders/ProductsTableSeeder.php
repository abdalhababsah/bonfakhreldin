<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        // Ensure categories exist
        if ($categories->isEmpty()) {
            $this->call(CategoriesTableSeeder::class);
            $categories = Category::all();
        }

        $products = [
            [
                'slug' => Str::slug('Arabica Coffee'),
                'name_en' => 'Arabica Coffee',
                'name_ar' => 'قهوة أرابيكا',
                'description_en' => 'High-quality Arabica beans.',
                'description_ar' => 'حبوب أرابيكا عالية الجودة.',
                'category_id' => $categories->where('name_en', 'Coffee')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Green Tea'),
                'name_en' => 'Green Tea',
                'name_ar' => 'شاي أخضر',
                'description_en' => 'Refreshing green tea.',
                'description_ar' => 'شاي أخضر منعش.',
                'category_id' => $categories->where('name_en', 'Tea')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Dark Chocolate'),
                'name_en' => 'Dark Chocolate',
                'name_ar' => 'شوكولاتة داكنة',
                'description_en' => 'Rich dark chocolate.',
                'description_ar' => 'شوكولاتة داكنة غنية.',
                'category_id' => $categories->where('name_en', 'Chocolate')->first()->id,
                'status' => 'active',
            ],
            // Add more products as needed
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}