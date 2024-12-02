<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_url',
        'is_primary',
        'alt_text_en',
        'alt_text_ar',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}