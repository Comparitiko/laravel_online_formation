<?php

namespace App\Http\Controllers;

use App\Enums\CourseState;
use App\Enums\RegistrationState;
use App\Enums\UserRole;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Resources\Course\BaseCourseResource;
use App\Models\Course;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('pages.dashboard');
    }

    /**
     * Login a user for the API
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function api_login(LoginRequest $request)
    {
        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password'], 400);
        }

        // Create a new token for the user
        $token = $this->createToken($user);

        return response()->json([
            'message' => 'Login successful',
            'token' => explode('|', $token)[1]
        ], 201);
    }

    /**
     * Register a new user for the API
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function api_register(RegisterRequest $request) {
        // Check if the user already exists
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'User already exists'], 400);
        }

        // Create a new user
        $user = new User();
        $user->fill($request->all());
        $user->save();

        // Create a new token for the user
        $token = $this->createToken($user);

        return response()->json([
            'message' => 'User created successfully',
            'token' => explode('|', $token)[1]
        ], 201);
    }

    /**
     * Create a new token for a specific user
     * @param User $user
     * @return string $token
     */
    private function createToken(User $user)
    {
        return $user->createToken('api_auth', ['*'], now()->addDay())->plainTextToken;
    }

    /**
     * Show all the confirmed courses of a student with pagination for the api
     * @param string $dni
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function api_show_all_registrations(Request $request, string $dni): JsonResponse|AnonymousResourceCollection
    {
        // Retrieve the user by dni and student role
        $student = User::where('dni', $dni)->where('role', UserRole::STUDENT)->get()->first();

        // Check if the user exists
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Get the limit from the request
        $limit = $request->query('limit', 10);

        $confirmedCourses = $student->confirmedCourses()->paginate($limit);

        // Check if the user can view the registrations of the student
        if ($request->user()->cannot('view', $student)) {
            abort(404);
        }

        return BaseCourseResource::collection($confirmedCourses);
    }

    /**
     * Create a new registration for a specific student to a specific course
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function api_new_registration(RegistrationRequest $request) {
        // Retrieve the user by id and student role
        $user = User::find($request->user_id)->where('role', UserRole::STUDENT)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Check if the user can create a registration
        if ($request->user()->id !== $request->user_id && $request->user()->role !== UserRole::ADMIN) {
            return response()->json(['message' => 'You are not allowed to create a registration'], 403);
        }

        // Retrieve the course by id
        $course = Course::find($request->course_id);

        // Check if the course is active
        if ($course->state !== CourseState::ACTIVE) {
            return response()->json(['message' => 'The course is not active'], 400);
        }

        // Check if the user already registered to the course
        if ($user->isStudentOf($course)) {
            return response()->json(['message' => 'User already registered to this course'], 400);
        }

        // Create the registration
        $user->studentCourses()->attach($request->course_id);
        $user->save();

        return response()->json(['message' => 'Registration created successfully'], 201);
    }

    public function api_delete_registration(Request $request, string $dni, int $course_id) {
        // Retrieve the user by id and student role
        $student = User::where('dni', $dni)->where('role', UserRole::STUDENT)->first();

        // Check if the user exists
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Check if the user can delete the registration
        if ($request->user()->id !== $student->id && $request->user()->role !== UserRole::ADMIN) {
            return response()->json(['message' => 'You are not allowed to cancel the registration'], 403);
        }

        // Retrieve the course by id
        $course = Course::find($course_id);

        // Check if student is registered to the course
        if (!$student->isStudentOf($course)) {
            return response()->json(['message' => 'Student is not registered to this course'], 400);
        }

        // Cancel the registration
        $student->studentCourses()->updateExistingPivot($course_id, ['state' => RegistrationState::CANCELLED]);
        $student->save();

        return response()->json(['message' => 'Registration deleted successfully']);
    }
}
