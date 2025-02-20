<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\User\RegistrationRequest;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
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
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        //
    }

    /**
     * Create a new registration for a specific student to a specific course
     *
     * @return JsonResponse
     */
    public function api_new_registration(RegistrationRequest $request)
    {
        // Retrieve the user by id and student role
        $user = User::find($request->student_id)->where('role', UserRole::STUDENT)->first();

        // Check if the user exists
        if (! $user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Create a new registration
        $registration = new Registration;
        $registration->fill($request->all());

        // Check if the user can create a registration
        if ($request->user()->cannot('createRegistration', $registration)) {
            return response()->json(['message' => 'You are not allowed to create a registration'], 403);
        }

        // Check if the registration already exists
        if ($registration->exists()) {
            return response()->json(['message' => 'Registration already exists'], 400);
        }

        // Check if the course is active
        if (! $registration->isCourseActive()) {
            return response()->json(['message' => 'The course is not active'], 400);
        }

        // Save the registration
        $registration->save();

        return response()->json(['message' => 'Registration created successfully'], 201);
    }
}
