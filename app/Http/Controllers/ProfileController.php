<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $tokens = DB::select(
            'SELECT token, name FROM personal_access_tokens WHERE tokenable_id = ?',
            [$request->user()->id]);

        return view('pages.profile.edit', [
            'user' => $request->user(),
            'tokens' => $tokens,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function generate_token(Request $request): RedirectResponse
    {
        // Create token with name
        $tokenName = $request->token_name ? $request->token_name : 'api_auth';

        $token = $request->user()->createToken($tokenName, ['*'], now()->addDay())->plainTextToken;

        if (! $token) {
            return redirect()->back()->withErrors(['token_name' => 'Error al crear el token']);
        }

        return redirect()->route('profile.edit');
    }
}
