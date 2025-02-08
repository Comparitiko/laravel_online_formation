<?php

namespace App\Enums;

enum CourseState: string
{
    case ACTIVE = 'active';
    case FINISHED = 'finished';
    case CANCELLED = 'cancelled';
}
