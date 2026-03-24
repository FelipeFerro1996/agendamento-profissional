<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        $exceptions->render(function (Throwable $e, $request) {

            if ($request->expectsJson()) {

                // Erro de validação
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erro de validação',
                        'errors' => $e->errors(),
                    ], 422);
                }

                // Erros HTTP (404, 403, etc)
                if ($e instanceof HttpExceptionInterface) {
                    return response()->json([
                        'success' => false,
                        'message' => $e->getMessage() ?: 'Erro na requisição',
                    ], $e->getStatusCode());
                }

                // Erro genérico
                return response()->json([
                    'success' => false,
                    'message' => 'Erro interno do servidor',
                    'error' => config('app.debug') ? $e->getMessage() : null,
                ], 500);
            }

            return null;
        });
    })->create();
