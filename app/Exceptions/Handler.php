<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if($exception instanceof NotFoundHttpException){
            return $this->returnErrorResponse('this model not found', Response::HTTP_NOT_FOUND);
        } elseif($exception instanceof MethodNotAllowedHttpException){
            return $this->returnErrorResponse('this method not allowed', Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);
    }
}
