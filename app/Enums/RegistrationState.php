<?php

namespace App\Enums;

enum RegistrationState: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all registration states names
     */
    public static function names(): array
    {
        return array_map(
            fn ($registrationState) => $registrationState->name,
            RegistrationState::cases()
        );
    }

    /**
     * Search a registration state by name
     */
    public static function enum($name): ?RegistrationState
    {
        return array_find(
            RegistrationState::cases(),
            fn ($registrationState) => $registrationState->name === $name
        );
    }

    public static function translate(RegistrationState $registrationState)
    {
        switch ($registrationState) {
            case self::CONFIRMED:
                return 'Confirmado';
            case self::CANCELLED:
                return 'Cancelado';
            case self::PENDING:
                return 'Pendiente';
        }
    }
}
