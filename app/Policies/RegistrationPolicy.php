<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Registration;
use App\Models\User;

class RegistrationPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return null;
    }

    public function createRegistration(User $user, Registration $registration): bool
    {
        return $user->id === $registration->student_id;
    }

    public function cancelRegistration(User $user, Registration $registration): bool
    {
        // Check if the user is the student that owns the registration
        if ($user->id === $registration->student_id) {
            return true;
        }
        dd($registration);

        // Check if the user is the teacher of the course
        if ($user->isTeacherOf($registration->course)) {
            return true;
        }

        return false;
    }
}
