<?php

namespace App\Enums;

enum OrderStatusEnums : string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Declined = 'declined';
    case Canceled = 'canceled';

    // Optional: Helper to get all values for validation so i can use it in the request like this Rule::enum(OrderStatusEnums::class)
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
