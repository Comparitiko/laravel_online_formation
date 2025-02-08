<?php

namespace App\Models;

use App\Enums\RegistrationState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    protected $casts = ['state' => RegistrationState::class];

    /**
     * @return BelongsTo<User>
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Course>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
