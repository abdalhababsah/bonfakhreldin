<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'category_id',
        'status',
        'price',
        'options',
    ];
    protected $casts = [
        'options' => 'array',
    ];
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sizes()
    {
        return $this->hasMany(\App\Models\ProductSize::class);
    }  

    public function getImageAttribute()
    {
        return $this->images()->where('is_primary', true)->value('image_url');
    }

}