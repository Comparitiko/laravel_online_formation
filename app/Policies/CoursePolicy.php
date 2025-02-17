<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Course;
use App\Models\User;

class CoursePolicy
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

    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        // Only admins and the teacher of the course can view the course
        if ($user->role === UserRole::ADMIN) return true;
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
    public function update(User $user, Course $course): bool
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
    public function delete(User $user, Course $course): bool
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
    public function restore(User $user, Course $course): bool
    {
        // Only admins can restore the registration
        if ($user->role === UserRole::ADMIN) return true;

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        // Only admins can permanently delete the registration
        if ($user->role === UserRole::ADMIN) return true;
        return false;
    }
}
