<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index() {
        return view('pages.dashboard');
    }

    public function api_show_all_registrations() {

    }

    public function api_new_registration() {

    }

    public function api_delete_registration() {

    }

    public function api_login(LoginRequest $request)
    {
        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password'], 400);
        }

        // Create a new token for the user
        $token = $user->createToken('api_auth')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => explode('|', $token)[1]
        ], 201);
    }

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
        $token = $user->createToken('api_auth')->plainTextToken;

        return response()->json([
            'message' => 'User created successfully',
            'token' => explode('|', $token)[1]
        ], 201);
    }
}
