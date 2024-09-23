<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login'); // Not authenticated
        }

        $user = Auth::user();
        if (!in_array($user->role->name, $roles)) {
            // If the user role is not in the allowed roles, redirect to home or any specific page
            return redirect('/')->withErrors(['message' => 'You do not have permission to access this page.']);
        }

        return $next($request); // Continue if role matches
    }
}
