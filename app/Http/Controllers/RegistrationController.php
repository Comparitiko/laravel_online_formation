<?php

namespace App\Http\Controllers;

use App\Enums\RegistrationState;
use App\Enums\UserRole;
use App\Http\Requests\User\RegistrationRequest;
use App\Mail\RegisterMail;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Handle route to show registrations, if the user is admin show all, if is teacher, show only his courses
     * registrations
     * @param Request $request
     * @return View
     */
    public function private_registrations(Request $request): View
    {
        if ($request->user()->isAdmin()) $registrations = Registration::paginate(10);
        else $registrations = Registration::getByTeacher($request->user())->paginate(10);

        return view('pages.private.registrations.registrations', ['registrations' => $registrations]);
    }

    /**
     * Handle route to search registrations with the filters
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function private_registrations_search(Request $request)
    {
        $courseName = $request->get('course_name', '');
        $studentName = $request->get('student_name', '');
        $registrationState = $request->get('registration_state', '');

        $registrationStateEnum = RegistrationState::enum($registrationState) ?? '';

        if ($request->user()->isAdmin()) {
            // Get all with the filters
            $registrations = Registration::whereHas('course', function ($query) use ($courseName) {
                $query->where('name', 'like', '%' . $courseName . '%');
            })
                ->whereHas('student', function ($query) use ($studentName) {
                    $query->where('name', 'like', '%' . $studentName . '%');
                });

            if ($registrationState) {
                $registrations = $registrations->where('state', $registrationStateEnum);
            };
        } else {
            // Get registrations by teacher with the filters
            $registrations = Registration::getByTeacher($request->user())
                ->whereHas('course', function ($query) use ($courseName) {
                    $query->where('name', 'like', '%' . $courseName . '%');
                })
                ->whereHas('student', function ($query) use ($studentName) {
                    $query->where('name', 'like', '%' . $studentName . '%');
                });
            if ($registrationState) {
                $registrations = $registrations->where('state', $registrationStateEnum);
            }
        }

        $registrations = $registrations->paginate(10);

        return view('pages.private.registrations.registrations', [
            'registrations' => $registrations,
            'course_name' => $courseName,
            'student_name' => $studentName,
            'registration_state' => $registrationState
        ]);
    }

    /**
     * Handle route to confirm a pending registration
     * @param Request $request
     * @param Registration $registration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function private_confirm_registration(Request $request, Registration $registration)
    {
        $user = $request->user();

        // Check if user cannot confirm registrations
        if ($user->cannot('updateRegistrationState', $registration)) abort(404);

        // Change the state
        $registration->state = RegistrationState::CONFIRMED;

        if (!$registration->save()) return redirect()->back()->withErrors(['error' => 'Hubo un problema al confirmar la inscripción']);

        // Send mail notification to the user
        $registration->student->sendEmailConfirmRegistrationNotification($registration);

        return redirect()->back();
    }

    /**
     * Handle route to confirm a pending registration
     * @param Request $request
     * @param Registration $registration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function private_cancel_registration(Request $request, Registration $registration)
    {
        $user = $request->user();

        // Check if user cannot confirm registrations
        if ($user->cannot('updateRegistrationState', $registration)) abort(404);

        // Change the state
        $registration->state = RegistrationState::CANCELLED;

        if (!$registration->save()) return redirect()->back()->withErrors(['error' => 'Hubo un problema al confirmar la inscripción']);

        // Send mail notification to the user
        $registration->student->sendEmailCancelRegistrationNotification($registration);

        return redirect()->back();
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
