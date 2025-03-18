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


    protected $appends = ['name', 'description'];

    protected $with = ['primaryImage'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the primary image for the product.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    // Localized Attributes
    public function getDescriptionAttribute()
    {
        return $this['description_' . app()->getLocale()];
    }
    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
}
