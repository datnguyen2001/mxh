<?php

namespace App\Exceptions;

use App\Helpers\LoggerHelpers;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $th
     * @return void
     */

    public function report(Throwable $th) {
        parent::report($th);
    }

    public function render($request, Throwable $th)
    {
        $status = $th instanceof HttpExceptionInterface ? $th->getStatusCode() : 500;
        if ($status == 500) {
            LoggerHelpers::CallApiSetLog('Exception url=[' .$request->getPathInfo().':'. $th->getMessage() . ':Controller= '.$th->getFile().':Line= '.$th->getLine().']' , '500');
        }
        return parent::render($request, $th);
    }
}
