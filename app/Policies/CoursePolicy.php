<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Course;
use App\Models\User;

class CoursePolicy
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
     * Check if the user can create a course
     * @return bool
     */
    public function createCourse(): bool
    {
        return false;
    }

    /**
     * Check if user can delete course
     * @return bool
     */
    public function deleteCourse(): bool
    {
        return false;
    }

    /**
     * Check if the user can cancel the course
     * @param User $user
     * @param Course $course
     * @return bool
     */
    public function cancelCourse(User $user, Course $course): bool
    {
        // Check if course is active
        if (!$course->isActive()) return false;

        // Check if the user is the teacher of the course
        if (!$user->isTeacherOf($course)) return false;

        return true;
    }
}
