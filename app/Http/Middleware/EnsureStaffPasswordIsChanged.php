<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStaffPasswordIsChanged
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (
            $user &&
            in_array($user->role, ['super_admin', 'result_officer', 'teacher'], true) &&
            $user->must_change_password &&
            ! $request->routeIs(
                'staff.password.edit',
                'staff.password.update',
                'staff.logout'
            )
        ) {
            return redirect()->route('staff.password.edit');
        }

        return $next($request);
    }
}

