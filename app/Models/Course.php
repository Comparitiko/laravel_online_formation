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

    protected $fillable = [
        'name',
        'description',
        'duration',
        'teacher_id',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'state' => CourseState::class,
        ];
    }

    /**
     * Get the category of the course
     *
     * @return BelongsTo<Category>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the teacher of the course
     *
     * @return BelongsTo<User>
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get all the course materials
     *
     * @return HasMany<CourseMaterial>
     */
    public function materials(): HasMany
    {
        return $this->hasMany(CourseMaterial::class);
    }

    /**
     * Get all the students of the course
     *
     * @return BelongsToMany<User>
     */
    public function registeredStudents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'registrations', 'course_id', 'student_id')->withPivot('confirmed');
    }

    /**
     * Get all the registrations of the course
     *
     * @return HasMany<Registration>
     */
    public function studentRegistrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get all the evaluations of the course
     *
     * @return HasMany<Evaluation>
     */
    public function studentEvaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
