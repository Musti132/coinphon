<?php

namespace App\Exceptions;

use App\Helpers\Response;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $e)
    {
        /**
         * Change default \ModelNotFoundException view to JSON Response
         */

        if ($e instanceof ModelNotFoundException) {
            return Response::notFound();
        }

        /**
         * Change default \NotFoundHttpException view to JSON Response
         */
        if ($e instanceof NotFoundHttpException) {
            return Response::notFound();
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return Response::notFound();
        }

        return parent::render($request, $e);
    }
}
