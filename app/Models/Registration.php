<?php

namespace App\Models;

use App\Enums\CourseState;
use App\Enums\RegistrationState;
use Database\Factories\RegistrationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Registration extends Pivot
{
    /** @use HasFactory<RegistrationFactory> */
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'course_id',
        'student_id',
    ];

    protected function casts(): array
    {
        return [
            'state' => RegistrationState::class,
        ];
    }

    /**
     * Get all registrations of one teacher
     * @param User $user
     * @return array<Registration>
     */
    public static function getByTeacher(User $user): array
    {
        $courses = $user->teacherCourses();
        $registrations = Registration::all();
    }

    /**
     * Get the course that owns the registration.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the student that owns the registration.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Check if the registration exists
     */
    public function exists(): bool
    {
        $registration = Registration::where('course_id', $this->course_id)->where('student_id', $this->student_id)->first();

        return $registration !== null;
    }

    /**
     * Check if the course is active or not
     */
    public function isCourseActive(): bool
    {
        return $this->course->state === CourseState::ACTIVE;
    }
}
