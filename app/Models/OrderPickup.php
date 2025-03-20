<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPickup extends Model
{
    protected $fillable = [
        'order_id',
        'branch',
    ];

    //relationship
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
