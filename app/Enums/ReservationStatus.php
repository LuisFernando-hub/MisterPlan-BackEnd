<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';


    public static function fromValue(string $value): string
    {
        return match($value) {
            self::PENDING->value => 'pending',
            self::CONFIRMED->value => 'confirmed',
            self::CANCELLED->value => 'cancelled'
        };
    }
}
