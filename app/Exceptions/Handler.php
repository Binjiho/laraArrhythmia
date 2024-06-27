<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (\Exception $e, $request) {
            if ($this->isHttpException($e)) {
                return $this->handleException($request, $e);
            }
        });
    }

    public function handleException($request, \Exception $exception)
    {
        $statusCode = $exception->getStatusCode();
        
        switch ($statusCode) {
            case 500:
                return errorServerRedirect();

            case 404:
                return NotFoundRedirect();

            default:
                errorMsg($statusCode . ' ERROR');
                return callRedirect('default');

        }
    }
}
