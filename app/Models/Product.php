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
    ];


    protected $appends = ['name', 'description'];

    // Remove eager loading of primaryImage to handle fallback logic manually
    protected $with = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the primary image for the product or fallback to the first image or a default image.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    /**
     * Get the primary image URL or fallback to the first image or a default image.
     */
    public function getPrimaryImageUrlAttribute()
    {
        $primaryImage = $this->primaryImage()->first();
        if ($primaryImage) {
            return 'storage/' .$primaryImage->image_url;
        }

        $firstImage = $this->images()->first();
        return $firstImage ? 'storage/' .$firstImage->image_url : asset('images/default.png');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function additions()
    {
        return $this->hasManyThrough(Addition::class, Category::class, 'id', 'category_id', 'category_id', 'id');
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
