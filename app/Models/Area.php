<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'city_id',
    ];

    //relationship
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
