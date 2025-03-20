<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    protected $fillable =[
        'delivery_fee',
        'address',
        'area_id',
        'order_id',
    ];

    //relationship
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
