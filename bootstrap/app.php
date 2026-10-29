<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'pin.changed' => \App\Http\Middleware\EnsurePinIsChanged::class,
            'staff' => \App\Http\Middleware\EnsureStaff::class,
            'super_admin' => \App\Http\Middleware\EnsureSuperAdmin::class,
            'staff.password.changed' => \App\Http\Middleware\EnsureStaffPasswordIsChanged::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            return $request->is('parent/*')
                ? route('parent.login')
                : route('staff.login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
