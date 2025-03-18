<?php

namespace App\Enums;

enum OrderStatusEnums : string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Declined = 'declined';
    case Canceled = 'canceled';
}
