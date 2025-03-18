<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    protected $appends = ['name'];

    //relationship
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    // Localized Attributes
    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
}
