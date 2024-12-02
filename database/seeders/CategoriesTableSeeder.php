<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'slug' => Str::slug('Coffee'),
                'name_en' => 'Coffee',
                'name_ar' => 'قهوة',
                'description_en' => 'All types of coffee.',
                'description_ar' => 'جميع أنواع القهوة.',
            ],
            [
                'slug' => Str::slug('Tea'),
                'name_en' => 'Tea',
                'name_ar' => 'شاي',
                'description_en' => 'Variety of teas.',
                'description_ar' => 'مجموعة متنوعة من الشاي.',
            ],
            [
                'slug' => Str::slug('Chocolate'),
                'name_en' => 'Chocolate',
                'name_ar' => 'شوكولاتة',
                'description_en' => 'Delicious chocolates.',
                'description_ar' => 'شوكولاتة لذيذة.',
            ],
            // Add more categories as needed
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}