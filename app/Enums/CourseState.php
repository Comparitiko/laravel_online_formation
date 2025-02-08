<?php

namespace App\Enums;

enum CourseState: string
{
    case ACTIVE = 'active';
    case FINISHED = 'finished';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
