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
     */
    public function createCourseMaterials(User $user, Course $course): bool
    {
        return $user->isTeacher() && $user->isTeacherOf($course);
    }

    /**
     * Only teacher of the course and a student with a confirmed registration can see the course materials
     */
    public function seeCourseMaterials(User $user, Course $course): bool
    {
        // Check if user is the teacher of the course
        if ($user->isTeacherOf($course)) {
            return true;
        }

        // Check if the course is active
        if (! $course->isActive()) {
            return false;
        }

        // Check if the user is a student with a confirmed registration of the course
        if (! $user->isConfirmedStudentOf($course)) {
            return false;
        }

        return true;
    }

    /**
     * Check if the user can create a registration to the course
     */
    public function createRegistration(User $user, Course $course): bool
    {
        // Check is already registered on the course
        if ($user->isRegistered($course)) {
            return false;
        }

        // Check if the user is student
        if (! $user->isStudent()) {
            return false;
        }

        return true;
    }
}
