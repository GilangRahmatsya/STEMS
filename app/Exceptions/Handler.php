<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if ($this->shouldReport($e)) {
                Log::error('STEMS Error', [
                    'exception' => class_basename($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'url' => request()->fullUrl(),
                    'method' => request()->method(),
                    'user_id' => auth()->id() ?? null,
                    'ip' => request()->ip(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        });

        // Handle Model Not Found
        $this->renderable(function (ModelNotFoundException $e, $request) {
            return response()->view('errors.404', [], 404);
        });

        // Handle Not Found Http Exception
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->view('errors.404', [], 404);
        });

        // Handle Validation Exceptions
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);
            }

            return $e->response;
        });
    }

    /**
     * Determine if the exception should be reported.
     */
    protected function shouldReport(Throwable $exception): bool
    {
        return !($exception instanceof \Illuminate\Auth\AuthenticationException)
            && !($exception instanceof \Illuminate\Auth\Access\AuthorizationException)
            && parent::shouldReport($exception);
    }
}
