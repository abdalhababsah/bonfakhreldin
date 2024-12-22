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

        if ($categories->isEmpty()) {
            $this->call(CategoriesTableSeeder::class);
            $categories = Category::all();
        }

        $products = [
            [
                'slug' => Str::slug('Bonfackereldin Classic Coffee'),
                'name_en' => 'Bonfackereldin Classic Coffee',
                'name_ar' => 'قهوة بن فخر الدين كلاسيك',
                'description_en' => 'A classic coffee blend with rich flavors.',
                'description_ar' => 'خليط قهوة كلاسيكي ذو نكهة غنية.',
                'category_id' => $categories->where('name_en', 'Coffee')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Espresso Beans'),
                'name_en' => 'Bonfackereldin Espresso Beans',
                'name_ar' => 'حبوب اسبريسو بن فخر الدين',
                'description_en' => 'Perfectly roasted espresso beans.',
                'description_ar' => 'حبوب اسبريسو محمصة بعناية.',
                'category_id' => $categories->where('name_en', 'Coffee')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Milk Chocolate'),
                'name_en' => 'Bonfackereldin Milk Chocolate',
                'name_ar' => 'شوكولاتة بالحليب بن فخر الدين',
                'description_en' => 'Smooth and creamy milk chocolate.',
                'description_ar' => 'شوكولاتة بالحليب ناعمة وكريمية.',
                'category_id' => $categories->where('name_en', 'Chocolate')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Dark Chocolate'),
                'name_en' => 'Bonfackereldin Dark Chocolate',
                'name_ar' => 'شوكولاتة داكنة بن فخر الدين',
                'description_en' => 'Rich and intense dark chocolate.',
                'description_ar' => 'شوكولاتة داكنة غنية ومكثفة.',
                'category_id' => $categories->where('name_en', 'Chocolate')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Chocolate with Nuts'),
                'name_en' => 'Bonfackereldin Chocolate with Nuts',
                'name_ar' => 'شوكولاتة بالمكسرات بن فخر الدين',
                'description_en' => 'Delicious chocolate mixed with nuts.',
                'description_ar' => 'شوكولاتة لذيذة ممزوجة بالمكسرات.',
                'category_id' => $categories->where('name_en', 'Chocolate')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Premium Cashews'),
                'name_en' => 'Bonfackereldin Premium Cashews',
                'name_ar' => 'كاجو بن فخر الدين الفاخر',
                'description_en' => 'Premium quality roasted cashews.',
                'description_ar' => 'كاجو فاخر محمص.',
                'category_id' => $categories->where('name_en', 'Nuts')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Almonds'),
                'name_en' => 'Bonfackereldin Almonds',
                'name_ar' => 'لوز بن فخر الدين',
                'description_en' => 'Crunchy and delicious almonds.',
                'description_ar' => 'لوز لذيذ ومقرمش.',
                'category_id' => $categories->where('name_en', 'Nuts')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Mixed Nuts'),
                'name_en' => 'Bonfackereldin Mixed Nuts',
                'name_ar' => 'خلطة مكسرات بن فخر الدين',
                'description_en' => 'A mix of premium quality nuts.',
                'description_ar' => 'خليط مكسرات عالي الجودة.',
                'category_id' => $categories->where('name_en', 'Nuts')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Pistachios'),
                'name_en' => 'Bonfackereldin Pistachios',
                'name_ar' => 'فستق بن فخر الدين',
                'description_en' => 'Fresh and crunchy pistachios.',
                'description_ar' => 'فستق طازج ومقرمش.',
                'category_id' => $categories->where('name_en', 'Nuts')->first()->id,
                'status' => 'active',
            ],
            [
                'slug' => Str::slug('Bonfackereldin Coffee with Hazelnut'),
                'name_en' => 'Bonfackereldin Coffee with Hazelnut',
                'name_ar' => 'قهوة بالبندق بن فخر الدين',
                'description_en' => 'Delicious coffee infused with hazelnut flavor.',
                'description_ar' => 'قهوة لذيذة بنكهة البندق.',
                'category_id' => $categories->where('name_en', 'Coffee')->first()->id,
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}