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
     */
    public function createCourse(): bool
    {
        return false;
    }

    /**
     * Check if user can delete course
     */
    public function deleteCourse(): bool
    {
        return false;
    }

    /**
     * Check if user can edit the course
     */
    public function editCourse(User $user, Course $course): bool
    {
        // Only the teacher of the course can edit the course
        return $user->isTeacher() && $user->isTeacherOf($course);
    }

    /**
     * Check if the user can cancel the course
     */
    public function cancelCourse(User $user, Course $course): bool
    {
        // Check if course is active
        if (! $course->isActive()) {
            return false;
        }

        // Check if the user is the teacher of the course
        if (! $user->isTeacherOf($course)) {
            return false;
        }

        return true;
    }

    /**
     * Only teacher of the course can create courses materials
     * @param User $user
     * @param Course $course
     * @return bool
     */
    public function createCourseMaterials(User $user, Course $course): bool
    {
        return $user->isTeacher() && $user->isTeacherOf($course);
    }
}
