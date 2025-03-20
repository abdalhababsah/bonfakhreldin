<?php

namespace App\Models;

use App\Enums\OrderDeliverableEnums;
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
        'deliverable',
        'notes',
        'total_price',
    ];

    protected $casts = [
        'status' => OrderStatusEnums::class,
        'deliverable' => OrderDeliverableEnums::class,
        'total_price' => 'decimal:2',
    ];

    //relationship
    public function delivery()
    {
        return $this->hasOne(OrderDelivery::class);
    }

    public function pickup()
    {
        return $this->hasOne(OrderPickup::class);
    }
}
