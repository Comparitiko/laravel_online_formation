<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $userRole = $request->user()->role;

        // Check if the user is an admin
        if ($userRole === UserRole::ADMIN) {
            return $next($request);
        }
        // Check if user has required role
        if ($userRole->value === $role) {
            return $next($request);
        }

        // Return as not found because the user does not have the required role and not need to know the reason
        abort(404);
    }
}
