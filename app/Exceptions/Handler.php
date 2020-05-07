<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;
use Throwable;
use Illuminate\Http\Response;
use App\Traits\ApiResponse;
class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        //AuthorizationException::class,
        //HttpException::class,
        //ModelNotFoundException::class,
        //ValidationException::class,
        //QueryException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ValidationException){
            return $this->errorResponse("Introduzca los datos",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if($exception instanceof ModelNotFoundException){
            return $this->errorResponse($exception->getMessage(),Response::HTTP_NOT_FOUND);
        }
        /*if($exception instanceof QueryException){
            if($exception->errorInfo[1] === 1452){
                return $this->errorResponse("Hola",422);
            }
            //return $this->errorResponse("El email ya esta siendo utilizado",Response::HTTP_UNPROCESSABLE_ENTITY);
        }*/
        //return $exception;
        return parent::render($request, $exception);
    }
}
