<?php

use App\Http\Middleware\CheckUserRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => CheckUserRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            // Check if the request is an API request to return a JSON response
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            }

            // Return a 404 page for all other requests
            return response()->view('pages.errors.404', [], 404);
        });

        $exceptions->render(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 403) {
                // Check if the request is an API request to return a JSON response
                if ($request->is('api/*')) {
                    return response()->json([
                        'message' => 'Access denied',
                    ], 403);
                }

                // Return a 403 page for all other requests
                return response()->view('pages.errors.403', [], 403);

            }
        });
    })->create();
