<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePinIsChanged
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->user()
            && $request->user()->student_id
            && $request->user()->must_change_pin
            && ! $request->routeIs(
                'parent.pin.edit',
                'parent.pin.update',
                'parent.logout'
            )
        ) {
            return redirect()->route('parent.pin.edit');
        }

        return $next($request);
    }
}
