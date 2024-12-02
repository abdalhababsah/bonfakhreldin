<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
        'meta_description_en',
        'meta_description_ar',
        'thumbnail_url',
        'status',
    ];
}