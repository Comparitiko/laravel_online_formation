<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Registration;
use App\Models\User;

class RegistrationPolicy
{
    public function createRegistration(User $user, Registration $registration): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }

        return $user->id === $registration->student_id;
    }

    public function cancelRegistration(User $user, Registration $registration): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }
        // Check if the user is the student that owns the registration
        if ($user->id === $registration->student_id) {
            return true;
        }

        // Check if the user is the teacher of the course
        if ($user->isTeacherOf($registration->course)) {
            return true;
        }

        return false;
    }

    public function updateRegistrationState(User $user, Registration $registration): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }
        // Check if registration is pending
        if (! $registration->isPending()) {
            return false;
        }

        return $user->isTeacher() && $user->isTeacherOf($registration->course);
    }

    /**
     * Check if the user is teacher of that registration and is active and not has evaluation
     *
     * @return bool
     */
    public function createEvaluations(User $user, Registration $registration)
    {
        if (
            $user->isTeacher()
            && $user->isTeacherOf($registration->course)

            && ! $registration->evaluation()
        ) {
            return true;
        }

        return false;
    }
}
