<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\User\RegistrationRequest;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function private_registrations(Request $request): View
    {
        if ($request->user()->isAdmin()) $registrations = Registration::paginate(10);
        else $registrations = Registration::getByTeacher($request->user())->paginate(10);

        dd($registrations);

        return view('pages.private.registrations.registrations', ['registrations' => $registrations]);
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
