<?php

namespace App\Models;

use App\Enums\CourseState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function materials(): HasMany
    {
        return $this->hasMany(CourseMaterial::class);
    }

    public function registeredStudents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'registrations', 'course_id', 'student_id')->withPivot('confirmed');
    }

    public function studentsEvaluations(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'evaluations', 'course_id', 'student_id');
    }

    protected function casts(): array
    {
        return [
            'state' => CourseState::class,
        ];
    }
}
