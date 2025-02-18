<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class RegistrationPolicy
{
    /**
     * Check if user can do all the actions
     */
    public function before(User $user): ?bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return null;
    }

    /**
     * Can view any registration
     */
    public function viewRegistration(User $user): bool {}
}
