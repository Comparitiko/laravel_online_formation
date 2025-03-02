<?php

namespace App\Http\Controllers;

use App\Enums\RegistrationState;
use App\Enums\UserRole;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Course\BaseCourseResource;
use App\Models\Course;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        // Check if the user has verified email to force to verify
        if (! $request->user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        $role = $request->user()->role;
        if ($role === UserRole::STUDENT) {
            return redirect()->route('students.courses.index');
        }

        return redirect()->route('private.courses.index');
    }

    /**
     * Handle route to show all users
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function private_users()
    {
        $users = User::paginate(10);

        return view('pages.private.users.users', ['users' => $users]);
    }

    /**
     * Handle route to delete users
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function private_delete_user(Request $request, User $user): RedirectResponse
    {
        // Check if logged user cannot delete users
        if ($request->user()->cannot('delete', $user)) abort(404);

        // Check if user to remove has active registrations
        if ($user->hasActiveRegistrations()) abort(404);

        // Check if there is an error deleting user from db
        if (!$user->delete()) return redirect()->back()->withErrors(['error' => 'Hubo un problema al eliminar el usuario']);

        return redirect()->route('private.users.index');
    }

    /**
     * Login a user for the API
     *
     * @return JsonResponse
     */
    public function api_login(LoginRequest $request)
    {
        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password'], 400);
        }

        // Create a new token for the user
        $token = $this->createToken($user);

        return response()->json([
            'message' => 'Login successful',
            'token' => explode('|', $token)[1],
        ], 201);
    }

    /**
     * Register a new user for the API
     *
     * @return JsonResponse
     */
    public function api_register(RegisterRequest $request)
    {
        // Check if the user already exists
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'User already exists'], 400);
        }

        // Create a new user
        $user = new User;
        $user->fill($request->all());
        $user->save();

        // Create a new token for the user
        $token = $this->createToken($user);

        return response()->json([
            'message' => 'User created successfully',
            'token' => explode('|', $token)[1],
        ], 201);
    }

    /**
     * Create a new token for a specific user
     *
     * @return string $token
     */
    private function createToken(User $user)
    {
        return $user->createToken('api_auth', ['*'], now()->addDay())->plainTextToken;
    }

    /**
     * Show all the confirmed courses of a student with pagination for the api
     */
    public function api_show_all_registrations(Request $request, string $dni): JsonResponse|AnonymousResourceCollection
    {
        // Retrieve the user by dni and student role
        $student = User::where('dni', $dni)->where('role', UserRole::STUDENT)->get()->first();

        // Check if the user exists
        if (! $student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Get the limit from the request
        $limit = $request->query('limit', 10);

        $confirmedCourses = $student->confirmedCourses()->paginate($limit);

        // Check if the user can view the information of the student
        if ($request->user()->cannot('viewUser', $student)) {
            abort(404);
        }

        return BaseCourseResource::collection($confirmedCourses);
    }

    /**
     * Cancel a course registration for a specific student
     *
     * @return JsonResponse
     */
    public function api_cancel_registration(Request $request, string $dni, int $course_id)
    {
        // Retrieve the user by id and student role
        $student = User::where('dni', $dni)->where('role', UserRole::STUDENT)->first();

        // Check if the user exists
        if (! $student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $registration = Registration::where('course_id', $course_id)->where('student_id', $student->id)->first();

        // Check if the registration exists
        if (! $registration) {
            return response()->json(['message' => 'Registration not found'], 404);
        }

        // Check if the user can delete the registration
        if ($request->user()->cannot('cancelRegistration', $registration)) {
            return response()->json(['message' => 'You are not allowed to cancel the registration'], 403);
        }

        // Check if the registration is already cancelled
        if ($registration->state === RegistrationState::CANCELLED) {
            return response()->json(['message' => 'Registration is already cancelled'], 400);
        }

        // Update the registration state to cancelled
        $registration->state = RegistrationState::CANCELLED;
        if ($registration->save()) {
            return response()->json(['message' => 'Registration deleted successfully']);
        }

        return response()->json(['message' => 'Something went wrong while deleting the registration'])->setStatusCode(500);
    }
}
