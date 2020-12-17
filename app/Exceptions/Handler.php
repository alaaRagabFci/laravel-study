<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json(['message' => 'Model Not found'], Response::HTTP_NOT_FOUND);
        }

        if($exception instanceof NotFoundHttpException){
            return response()->json(['message' => 'Route Not Found, NotFoundHttpException'], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
            return response()->json(['message' => 'Method not allowed, MethodNotAllowedHttpException'], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof BadMethodCallException && $request->wantsJson()) {
            return response()->json(['message' => 'Check method called, BadMethodCallException , '. $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_FORBIDDEN);
        }

        return parent::render($request, $exception);
    }
}
