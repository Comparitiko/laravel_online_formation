<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class RegistrationPolicy
{
    /**
     * Check if user can do all the actions
     * @param User $user
     * @return bool|null
     */
    public function before(User $user): bool|null
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return null;
    }

    /**
     * Can view any registration
     * @param User $user
     * @return bool
     */
    public function viewRegistration(User $user): bool
    {

    }
}
