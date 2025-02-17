<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RegistrationState;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

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

    /**
     * Get all the courses of the user if the user is a student
     * @return BelongsToMany<Course>|null
     */
    public function confirmedCourses(): ?BelongsToMany
    {
        // Only students can have registrations
        if ($this->role === UserRole::STUDENT) {
            return $this->belongsToMany(
                Course::class,
                'registrations',
                'student_id',
                'course_id'
            )
                ->wherePivot('state', RegistrationState::CONFIRMED)->using(Registration::class);
        }

        return null;
    }

    /**
     * Get the courses evaluations of the user if the user is a student
     * @return BelongsToMany|null
     */
    public function coursesEvaluations(): ?BelongsToMany
    {
        if ($this->role === UserRole::STUDENT) {
            return $this->belongsToMany(Course::class, 'evaluations', 'student_id', 'course_id')->using(Evaluation::class);
        }

        return null;
    }

    public function isStudentOf(Course $course): bool
    {
        return $this->studentCourses->contains($course);
    }

    public function isSameUser(User $user): bool
    {
        return $this->id === $user->id;
    }

    public function studentCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'registrations', 'student_id', 'course_id')->using
            (Registration::class)->using(Registration::class);
    }
}
