<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (
            ! $user ||
            $user->role !== 'super_admin' ||
            $user->student_id !== null
        ) {
            abort(403, 'Only the Super Admin can manage staff accounts.');
        }

        return $next($request);
    }
}

