<?php

use App\Http\Middleware\InvalidAdmin;
use App\Http\Middleware\ValidAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('admin')
                ->middleware([
                    'web',
                ])
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'ValidAdmin' => ValidAdmin::class,
            'InvalidAdmin' => InvalidAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($request->is('api/*') or $request->is('app/*')) {
                $httpErrors = [
                    404 => __('errors.not_found'),
                    422 => __('errors.The_given_data_was_invalid'),
                    429 => __('errors.too_many_request'),
                    500 => __('errors.internal_error'),
                ];
                if (array_key_exists($e->getStatusCode(), $httpErrors)) {
                    return response()->json([
                        'status' => false,
                        'message' => $httpErrors[$e->getStatusCode()],
                    ], $e->getStatusCode());
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => $e->getMessage(),
                    ], $e->getStatusCode());
                }
            }
        });
    })->create();
