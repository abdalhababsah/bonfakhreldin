<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'product_id',
    ];
    protected $appends = ['name'];

    //relationship
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Localized Attributes
    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
}
