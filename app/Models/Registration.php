<?php

namespace App\Models;

use App\Enums\RegistrationState;
use Database\Factories\RegistrationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Registration extends Pivot
{
    /** @use HasFactory<RegistrationFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'state' => RegistrationState::class,
        ];
    }
}
