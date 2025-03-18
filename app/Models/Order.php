<?php

namespace App\Models;

use App\Enums\OrderStatusEnums;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'name',
        'email',
        'phone',
        'status',
        'notes',
        'total_price',
        'delivery_fee',
        'address',
        'area_id',
    ];

    protected $casts = [
        'status' => OrderStatusEnums::class,
        'total_price' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
    ];

    //relationship
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
