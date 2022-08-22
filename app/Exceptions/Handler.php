<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

        $this->renderable(function (Exception $e,$request) {

                if($request->wantsJson()){
                    $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 400;

                    if(!empty($e)){
                    $response = [
                        'status' => $e->getMessage(),
                        'message' => $e->getMessage()
                    ];

                    if($e instanceof ValidationException){
                        $status = 400;
                        function_exists(getStatusCode());
                        $response['status'] = $status;

                    }else if($e instanceof AuthenticationException){

                        $status = 401;
                        $response['message'] = 'ابتدا در سایت وارد شوید!';
                        $response['status'] = $status;

                        //is it DB exception
                    }else if($e instanceof \PDOException){

                        $status = 500;

                        $response['message'] = 'درخواست شما نیمه تمام ماند!';
                        $response['status'] = $status;

                    }else if($this->isHttpException($e)){

                        $status = 404;
                        $response['message'] = 'این درخواست وجود ندارد!';
                        $response['status'] = $status;


                    }

                    return response()->json($response,$status);
                }

            }



        });


    }
}
