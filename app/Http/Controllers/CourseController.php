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
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Handle route to show courses in the private side of the web
     * @param Request $request
     * @return Factory|\Illuminate\Contracts\View\View|Application|object
     */
    public function private_courses(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) $courses = Course::paginate(10);
        else $courses = Course::where('teacher_id', $user->id)->paginate(10);

        return view('pages.private.courses', ['courses' => $courses]);
    }

    /**
     * Handle route to finish a course in the private side of the web
     * @param Course $course
     * @param Request $request
     * @return RedirectResponse
     */
    public function private_finish_course(Course $course, Request $request): RedirectResponse
    {
        if ($request->user()->cannot('cancelCourse', $course)) abort(404);

        // Update the course state
        $course->state = CourseState::FINISHED;
        $course->save();

        return redirect()->route('private.courses.index');
    }

    /**
     * Handle the route to show all courses in the public side of the webº
     * @return View
     */
    public function public_course_index(): View
    {
        return view('pages.public.courses');
    }

    /**
     * Handle route to show all courses in API
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
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

    /**
     * Handle route to show the information of one course in API
     * @param Course $course
     * @return AllInfoCourseResource
     */
    public function api_show(Course $course)
    {
        return AllInfoCourseResource::make($course);
    }

    /**
     * Handle route to create a course in API
     * @param CreateCourseRequest $request
     * @return JsonResponse
     */
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

    /**
     * Handle route to delete a course in API
     * @param Request $request
     * @param Course $course
     * @return JsonResponse
     */
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
