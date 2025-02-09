<?php

namespace App\Http\Controllers;

use App\Enums\CourseState;
use App\Http\Resources\Course\AllInfoCourseResource;
use App\Http\Resources\Course\BaseCourseResource;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function api_index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $category = $request->get('category');
        $state = $request->get('state');

        // Get all courses with the given category and state
        if($category && $state) {
            // Get the category name
            $categoryName = Category::where('course_area_name', $category)->get()->first();

            if (!$categoryName) return response()->json(['message' => 'Invalid category'], 400);

            // Check if the state is valid
            $states = CourseState::values();
            if (!in_array($state, $states)) return response()->json(['message' => 'Invalid state'], 400);

            $courses = Course::where('category_id', $categoryName->id)->where('state', $state)->paginate($limit);
        } else {
            // Get all courses if category and state are nulls
            if (!$category && !$state) $courses = Course::paginate($limit);
            else if (!$category) {
                // Get all courses with the given state
                $states = CourseState::values();

                if (!in_array($state, $states)) return response()->json(['message' => 'Invalid state'], 400);

                $courses = Course::where('state', $state)->paginate($limit);
            } else if (!$state) {
                // Get all courses with the given category
                $categoryName = Category::where('course_area_name', $category)->get()->first();

                if (!$categoryName) return response()->json(['message' => 'Invalid category'], 400);

                $courses = Course::where('category_id', $categoryName->id)->paginate($limit);
            }

        }
        return BaseCourseResource::collection($courses);
    }

    public function api_show(int $id) {
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return AllInfoCourseResource::make($course);
    }
    }

    public function api_create(Request $request) {

    }

    public function api_delete(Course $course) {

    }


}
