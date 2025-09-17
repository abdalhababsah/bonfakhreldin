<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'price',
        'with_qty', // this is a boolean that will be used to determine if the addition has a quantity or not when added to cart with product
        'category_id',
    ];
    protected $appends = ['name'];
    protected $casts = [
        'price' => 'decimal:2',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
}
