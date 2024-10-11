<?php

use App\Http\Middleware\Authentication;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Src\Shared\Domain\Exception\BaseException;
use Src\Shared\Domain\Exception\UserAlreadyHasProfileException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(
            [
                Authentication::class,
            ]
            );
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function(BaseException $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
                // 'errors' => $e->getErrors(),
            ], $e->getCode());
        });
    })->create();

