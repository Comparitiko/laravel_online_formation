<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Evaluation extends Pivot
{
    /** @use HasFactory<\Database\Factories\EvaluationFactory> */
    use HasFactory;
}
