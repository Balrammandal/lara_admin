<?php

namespace App\Exceptions;

use Auth;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Request;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($this->isHttpException($exception))
        {
            switch ($exception->getStatusCode())
            {
                // not found
                case 404:
                    $segment = Request::segment(1);
                    if($segment=='cpanel'){
                        if(isset(Auth::user()->id)){
                            $user = Auth::user();
                        }else{
                            $user ='';
                        }
                        return response()->make(view('admin.error_page.index',compact('user')), 404);
                    }else{
                        if(isset(Auth::user()->id)){
                            $user = Auth::user();
                        }else{
                            $user ='';
                        }
                        return response()->make(view('frontend.error_page.index',compact('user')), 404);
                    }

                    break;

                // internal error
                case '500':
                    $segment = Request::segment(1);
                    if($segment=='cpanel'){
                        if(isset(Auth::user()->id)){
                            $user = Auth::user();
                        }else{
                            $user ='';
                        }
                        return response()->make(view('admin.error_page.internal_error',compact('user')), 404);
                    }else{
                        if(isset(Auth::user()->id)){
                            $user = Auth::user();
                        }else{
                            $user ='';
                        }
                        return response()->make(view('frontend.error_page.internal_error',compact('user')), 404);
                    }

                    break;

                default:
                    return $this->renderHttpException($exception);
                    break;
            }
        }
        else
        {
            return parent::render($request, $exception);
        }
    }
}
