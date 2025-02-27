<?php

namespace App\Http\Controllers;

use App\Enums\CourseState;
use App\Enums\UserRole;
use App\Http\Requests\Courses\CreateCourseRequest;
use App\Http\Resources\Course\AllInfoCourseResource;
use App\Http\Resources\Course\BaseCourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function private_courses()
    {
        $courses = Course::paginate(10);

        return view('pages.private.courses', ['courses' => $courses]);
    }

    public function public_course_index(): View
    {
        return view('pages.public.courses');
    }

    public function api_index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $category = $request->get('category');
        $state = $request->get('state');

        // Get all courses with the given category and state
        if ($category && $state) {
            // Get the category name
            $categoryName = Category::where('course_area_name', $category)->get()->first();

            if (! $categoryName) {
                return response()->json(['message' => 'Invalid category'], 400);
            }

            // Check if the state is valid
            $states = CourseState::values();
            if (! in_array($state, $states)) {
                return response()->json(['message' => 'Invalid state'], 400);
            }

            $courses = Course::where('category_id', $categoryName->id)->where('state', $state)->paginate($limit);
        } else {
            // Get all courses if category and state are nulls
            if (! $category && ! $state) {
                $courses = Course::paginate($limit);
            } elseif (! $category) {
                // Get all courses with the given state
                $states = CourseState::values();

                if (! in_array($state, $states)) {
                    return response()->json(['message' => 'Invalid state'], 400);
                }

                $courses = Course::where('state', $state)->paginate($limit);
            } elseif (! $state) {
                // Get all courses with the given category
                $categoryName = Category::where('course_area_name', $category)->get()->first();

                if (! $categoryName) {
                    return response()->json(['message' => 'Invalid category'], 400);
                }

                $courses = Course::where('category_id', $categoryName->id)->paginate($limit);
            }

        }

        return BaseCourseResource::collection($courses);
    }

    public function api_show(Course $course)
    {
        return AllInfoCourseResource::make($course);
    }

    public function api_create(CreateCourseRequest $request)
    {
        // Check if the user can create a course
        if ($request->user()->cannot('createCourse', Course::class)) {
            return response()->json(['message' => 'You are not allowed to create a course'], 403);
        }

        // Check if the teacher id is a real teacher
        $teacher = User::find($request->teacher_id)->where('role', UserRole::TEACHER)->first();

        if (! $teacher) {
            return response()->json(['message' => 'The teacher_id is not a valid id']);
        }

        // Create the new course
        $course = new Course;
        $course->fill($request->all());
        $course->save();

        return response()->json(['message' => 'Course created successfully']);
    }

    public function api_delete(Request $request, Course $course)
    {
        if ($request->user()->cannot('deleteCourse', Course::class)) {
            return response()->json(['message' => 'You are not authorized to delete this course'], 403);
        }

        if ($course->delete()) {
            return response()->json(['message' => 'Course deleted successfully']);
        }

        return response()->json(['message' => 'Error deleting course'], 400);
    }
}
