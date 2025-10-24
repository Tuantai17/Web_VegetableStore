<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LoginAdminMiddleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'loginadmin' => LoginAdminMiddleware::class,
        ]);

        // $middleware->append(LoginAdminMiddleware::class );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 
    })
    ->create();
