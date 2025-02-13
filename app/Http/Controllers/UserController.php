<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Course\BaseCourseResource;
use App\Models\User;
use App\Policies\RegistrationPolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index() {
        return view('pages.dashboard');
    }

    public function api_show_all_registrations(string $dni) {
        // Retrieve the user by dni
        $user = User::where('dni', $dni)->first;

        $courses = $user->registrations->course;

        return BaseCourseResource::collection($courses);
    }

    public function api_new_registration() {

    }

    public function api_delete_registration() {

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
}
