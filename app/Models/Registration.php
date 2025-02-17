<?php

namespace App\Models;

use App\Enums\RegistrationState;
use Database\Factories\RegistrationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
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
