<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RegistrationState;
use App\Enums\UserRole;
use App\Notifications\VerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'dni',
        'username',
        'name',
        'surnames',
        'email',
        'phone_number',
        'address',
        'city',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Check if the user is the same user as the model parameter
     */
    public function isSameUser(User $model): bool
    {
        return $this->id === $model->id;
    }

    /**
     * Get all the courses of the user if the user is a student
     *
     * @return BelongsToMany<Course>|null
     */
    public function confirmedCourses(): ?BelongsToMany
    {
        // Only students can have registrations
        if ($this->role !== UserRole::STUDENT) {
            return null;
        }

        return $this->belongsToMany(
            Course::class,
            'registrations',
            'student_id',
            'course_id'
        )
            ->wherePivot('state', RegistrationState::CONFIRMED)->using(Registration::class);
    }

    /**
     * Get all the courses of the teacher
     */
    public function teacherCourses(): ?HasMany
    {
        if ($this->role !== UserRole::TEACHER) {
            return null;
        }

        return $this->hasMany(Course::class, 'id', 'teacher_id');
    }

    /**
     * Get all the courses of the student
     */
    public function studentCourses(): ?BelongsToMany
    {
        if ($this->role !== UserRole::STUDENT) {
            return null;
        }

        return $this->belongsToMany(Course::class, 'registrations', 'student_id', 'course_id')
            ->using(Registration::class)
            ->withPivot('state');
    }

    /**
     * Check if the user is a teacher of the course
     */
    public function isTeacherOf(Course $course): bool
    {
        return $course->teacher_id === $this->id;
    }
}
