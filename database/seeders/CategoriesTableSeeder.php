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
                'slug' => Str::slug('Chocolate'),
                'name_en' => 'Chocolate',
                'name_ar' => 'شوكولاتة',
                'description_en' => 'Delicious chocolates.',
                'description_ar' => 'شوكولاتة لذيذة.',
            ],
            [
                'slug' => Str::slug('Nuts'),
                'name_en' => 'Nuts',
                'name_ar' => 'مكسرات',
                'description_en' => 'Premium quality nuts.',
                'description_ar' => 'مكسرات عالية الجودة.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}