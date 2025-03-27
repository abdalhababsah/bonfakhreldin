<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
    ];
    
    protected $appends = ['name'];

    //relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Localized Attributes
    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
}