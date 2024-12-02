<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Product;

class ProductImagesTableSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Primary Image
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => 'images/products/' . $product->slug . '-primary.jpg', // Ensure these images exist
                'is_primary' => true,
                'alt_text_en' => $product->name_en . ' primary image',
                'alt_text_ar' => 'صورة ' . $product->name_ar . ' الرئيسية',
            ]);

            // Additional Images
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => 'images/products/' . $product->slug . '-secondary.jpg',
                'is_primary' => false,
                'alt_text_en' => $product->name_en . ' secondary image',
                'alt_text_ar' => 'صورة ' . $product->name_ar . ' الثانوية',
            ]);

            // Add more images if needed
        }
    }
}