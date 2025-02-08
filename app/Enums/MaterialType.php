<?php

namespace App\Enums;

enum MaterialType: string
{
    case PDF = 'pdf';
    case VIDEO = 'video';
    case LINK = 'link';
    case REPOSITORY = 'repository';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
