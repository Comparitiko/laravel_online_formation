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

    /**
     * Get all material types names
     */
    public static function names(): array
    {
        return array_map(
            fn ($materialType) => $materialType->name,
            MaterialType::cases()
        );
    }

    /**
     * Search a material type by name
     */
    public static function enum($name): MaterialType
    {
        return array_find(
            MaterialType::cases(),
            fn ($materialType) => $materialType->name === $name
        );
    }
}
