<?php

namespace App\Http\Controllers;

use App\Http\Requests\Evaluation\CreateEvaluationRequest;
use App\Models\Evaluation;
use App\Models\Registration;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function private_evaluations(Request $request)
    {
        $user = $request->user();
        if ($user->isAdmin()) {
            $registrations = Registration::getConfirmed($user)->paginate(10);
        } else {
            $registrations = Registration::getConfirmedByTeacher($user)->paginate(10);
        }

        return view('pages.private.evaluations.evaluations', [
            'registrations' => $registrations,
        ]);
    }

    public function private_create_evaluation_form(Request $request, Registration $registration)
    {
        // Ckeck if the user cannot create evaluations of that registration
        if ($request->user()->cannot('createEvaluations', $registration)) {
            abort(404);
        }

        return view('pages.private.evaluations.create-evaluation', ['registration' => $registration]);
    }

    public function private_create_evaluation(CreateEvaluationRequest $request, Registration $registration)
    {
        // Ckeck if the user cannot create evaluations of that registration
        if ($request->user()->cannot('createEvaluations', $registration)) {
            abort(404);
        }

        // Create evaluation
        $evaluation = new Evaluation;
        $evaluation->fill($request->all());
        $evaluation->student_id = $registration->student_id;
        $evaluation->course_id = $registration->course_id;

        // Save evaluation
        if (! $evaluation->save()) {
            return back()->withErrors(['error' => 'Ha surgido un error al crear la evaluación']);
        }

        return redirect()->route('private.evaluations.index');
    }
}
