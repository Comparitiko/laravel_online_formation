<?php

namespace App\Http\Resources\Course;

use App\Http\Resources\Category\BaseCategoryResource;
use App\Http\Resources\User\BaseTeacherResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllInfoCourseResource extends BaseCourseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'category' => BaseCategoryResource::make($this->category),
            'teacher' => BaseTeacherResource::make($this->teacher),
        ]);
    }
}
