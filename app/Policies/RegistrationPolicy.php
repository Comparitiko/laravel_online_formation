<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RegistrationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Only admins can view any registration
        if ($user->role === UserRole::ADMIN) return true;

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Registration $registration): bool
    {
        // Only admins, the teacher of the course and the student can view the registration
        if ($user->role === UserRole::ADMIN) return true;
        if ($user->role === UserRole::TEACHER && $registration->course->teacher->id === $user->id) return true;
        if ($user->id === $registration->student->id) return true;

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // All users can create registrations
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Registration $registration): bool
    {
        // Only admins, the teacher of the course and the student can update the registrations
        if ($user->role === UserRole::ADMIN) return true;
        if ($user->role === UserRole::TEACHER && $registration->course->teacher->id === $user->id) return true;
        if ($user->id === $registration->student->id) return true;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Registration $registration): bool
    {
        // Only admins, the teacher of the course and the student can delete the registrations
        if ($user->role === UserRole::ADMIN) return true;
        if ($user->role === UserRole::TEACHER && $registration->course->teacher->id === $user->id) return true;
        if ($user->id === $registration->student->id) return true;

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Registration $registration): bool
    {
        // Only admins can restore the registration
        if ($user->role === UserRole::ADMIN) return true;

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Registration $registration): bool
    {
        // Only admins can permanently delete the registration
        if ($user->role === UserRole::ADMIN) return true;
        return false;
    }
}
