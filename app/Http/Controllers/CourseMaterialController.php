<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller {
    public function public_course_materials(Request $request, Course $course)
    {
        // Check if user can see the course materials
        if ($request->user()->cannot('seeCourseMaterials', $course)) abort(404);

        // Get materials of the course with the course relationship eager
        $materials = $course->materials()->with('course')->get();

        return view('pages.public.materials.index', ['materials' => $materials]);
    }
}
