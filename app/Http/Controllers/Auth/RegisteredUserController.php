<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterViewRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('pages.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterViewRequest $request): RedirectResponse
    {
        // Create new user and save
        $user = new User;
        $user->fill($request->all());
        $user->save();

        // Send email verification
        $user->sendEmailVerificationNotification();

        // Log in the user
        Auth::login($user);

        return redirect(route('index', absolute: false));
    }
}
