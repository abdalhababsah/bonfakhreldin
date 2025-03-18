<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
        'size',
        'option',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    protected $with = ['product'];

    //relationship
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
