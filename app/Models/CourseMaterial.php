<?php

namespace App\Models;

use App\Enums\MaterialType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\CourseMaterialFactory> */
    use HasFactory;

    protected $fillable = ['url', 'type', 'course_id'];

    protected $casts = ['type' => MaterialType::class];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected function casts(): array
    {
        return [
            'type' => MaterialType::class,
        ];
    }
}
