<?php

namespace App\Http\Controllers;

use App\Enums\CourseState;
use App\Enums\UserRole;
use App\Http\Requests\CourseMaterial\CreateCourseMaterialRequest;
use App\Http\Requests\Courses\CreateCourseRequest;
use App\Http\Requests\Courses\CreateFormCourseRequest;
use App\Http\Requests\Courses\EditFormCourseRequest;
use App\Http\Resources\Course\AllInfoCourseResource;
use App\Http\Resources\Course\BaseCourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Handle route to show courses in the private side of the web
     *
     * @return Factory|\Illuminate\Contracts\View\View|Application|object
     */
    public function private_courses(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $courses = Course::paginate(10);
        } else {
            $courses = Course::where('teacher_id', $user->id)->paginate(10);
        }

        return view('pages.private.courses.courses', ['courses' => $courses]);
    }

    /**
     * Handle route to finish a course in the private side of the web
     */
    public function private_finish_course(Course $course, Request $request): RedirectResponse
    {
        if ($request->user()->cannot('cancelCourse', $course)) {
            abort(404);
        }

        // Update the course state
        $course->state = CourseState::FINISHED;
        $course->save();

        // Redirect back to the last page visited
        return redirect()->back();
    }

    /**
     * Handle route to create a new course, only admins can
     *
     * @return Factory|\Illuminate\Contracts\View\View|Application|object
     */
    public function private_create_courses_form(Request $request): View
    {
        // Check if user can create a new course
        if ($request->user()->cannot('createCourse', Course::class)) {
            abort(404);
        }

        // Get teachers names and ids from cache
        $teachers = $this->getTeachersNamesFromCache();

        // Retrieve categories ids and names from cache
        $categories = $this->getCategoriesNamesFromCache();

        return view('pages.private.courses.create-course', [
            'categories' => $categories,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Handle route to create a new course retrieving the course from the request
     */
    public function private_create_courses(CreateFormCourseRequest $request): RedirectResponse
    {
        // Check if user can create a new course
        if ($request->user()->cannot('createCourse', Course::class)) {
            abort(404);
        }

        // Save course
        $course = new Course;
        $course->fill($request->all());
        $course->save();

        return redirect()->route('private.courses.index');
    }

    /**
     * Handle route to delete courses in the private side of the web
     */
    public function private_delete_course(Request $request, Course $course): RedirectResponse
    {
        // Check if user can delete the course
        if ($request->user()->cannot('deleteCourse', Course::class)) {
            abort(404);
        }

        // If error while deleting the course redirect back with error message
        if (! $course->delete()) {
            return redirect()->back()->with('error', 'Prueba de nuevo mas tarde');
        }

        // Redirect back to the last page visited
        return redirect()->back();
    }

    /**
     * Handle route the view of the form to edit a course in the private side of the web
     *
     * @param  CreateFormCourseRequest  $request
     */
    public function private_edit_course_form(Request $request, Course $course): View
    {
        // Check if user can edit a course
        if ($request->user()->cannot('editCourse', $course)) abort(404);

        // Get teachers names and ids from cache if is admin, if not send only the user of the logged in teacher
        if ($request->user()->isAdmin()) $teachers = $this->getTeachersNamesFromCache();
        else $teachers[] = $request->user();

        // Retrieve categories ids and names from cache
        $categories = $this->getCategoriesNamesFromCache();

        return view('pages.private.courses.edit-course', [
            'course' => $course,
            'teachers' => $teachers,
            'categories' => $categories,
        ]);
    }

    /**
     * Handle route the edit course with the incoming request
     */
    public function private_edit_course(EditFormCourseRequest $request, Course $course): RedirectResponse
    {
        // Check if user can edit a course
        if ($request->user()->cannot('editCourse', $course)) {
            abort(404);
        }

        // If database fail send an error message
        if (!$course->update($request->all())) {
            return redirect()->back()->with('error', 'Error en el servidor vuelve a intentarlo mas tarde');
        }

        return redirect()->route('private.courses.index');
    }

    public function private_add_material_course_form(Request $request, Course $course): View
    {
        // Check if user cannot create course materials in the course
        if ($request->user()->cannot('createCourseMaterials', $course)) abort(404);

        return view('pages.private.courses.add-course-material', ['course' => $course]);
    }

    public function private_add_material_course(CreateCourseMaterialRequest $request, Course $course): RedirectResponse
    {
//        $request->file('file')->store('files');

        Storage::put('files', $request->file());
        return redirect()->route('private.courses.index');
    }

    /**
     * Handle the route to show all courses in the public side of the web
     */
    public function public_course_index(): View
    {
        return view('pages.public.courses.courses');
    }

    /**
     * Handle route to show all courses in API
     *
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
     *
     * @return AllInfoCourseResource
     */
    public function api_show(Course $course)
    {
        return AllInfoCourseResource::make($course);
    }

    /**
     * Handle route to create a course in API
     *
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
     *
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

    /**
     * Get all the teacher names and ids from the cache
     *
     * @return mixed
     */
    private function getTeachersNamesFromCache()
    {
        // If the data are not in cache retrieve from database and then save it
        if (! Cache::has('teachers_names')) {
            $teachers = User::select('id', 'name')->where('role', UserRole::TEACHER)->get();
            Cache::put('teachers_names', $teachers, now()->addHours(2));
        } else {
            $teachers = Cache::get('teachers_names');
        }

        return $teachers;
    }

    /**
     * Get all the categories names and ids from the cache
     *
     * @return mixed
     */
    private function getCategoriesNamesFromCache()
    {
        // If the data are not in cache retrieve from database and then save it
        if (! Cache::has('categories_names')) {
            $categories = Category::select('id', 'course_area_name')->get();
            Cache::put('categories_names', $categories, now()->addHours(2));
        } else {
            $categories = Cache::get('categories_names');
        }

        return $categories;
    }
}
