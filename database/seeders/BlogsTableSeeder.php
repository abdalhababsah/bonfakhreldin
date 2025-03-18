<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Blog;
use Faker\Factory as Faker;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US'); // For English content
        $faker_ar = Faker::create('ar_JO'); // For Arabic content

        $blogs = [
            [
                'slug' => Str::slug('The Art of Coffee Making'),
                'title_en' => 'The Art of Coffee Making',
                'title_ar' => 'فن تحضير القهوة',
                'content_en' => $faker->paragraphs(5, true),
                'content_ar' => $faker_ar->paragraphs(5, true),
                'meta_description_en' => 'Learn the secrets of making great coffee.',
                'meta_description_ar' => 'تعلم أسرار صنع قهوة رائعة.',
                'thumbnail_url' => 'images/blogs/coffee-art.jpg', // Ensure this image exists
                'status' => 'published',
            ],
            [
                'slug' => Str::slug('Health Benefits of Green Tea'),
                'title_en' => 'Health Benefits of Green Tea',
                'title_ar' => 'فوائد الشاي الأخضر الصحية',
                'content_en' => $faker->paragraphs(5, true),
                'content_ar' => $faker_ar->paragraphs(5, true),
                'meta_description_en' => 'Discover the benefits of green tea.',
                'meta_description_ar' => 'اكتشف فوائد الشاي الأخضر.',
                'thumbnail_url' => 'images/blogs/green-tea.jpg', // Ensure this image exists
                'status' => 'published',
            ],
            // Add more blogs as needed
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}