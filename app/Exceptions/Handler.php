<?php

namespace App\Exceptions;

use App\Http\Traits\Api\ApiResponseTrait;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        // https://docs.sentry.io/platforms/php/guides/laravel/
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
            // Integration::captureUnhandledException($e);
        });
    }


    /**
     * Report or log an exception.
     *
     * @param Throwable $e
     *
     * @return void
     *
     * @throws Exception|Throwable
     */
    public function report(Throwable $e): void
    {
        $ignoreable_exception_messages = ['Unauthenticated or Token Expired, Please Login'];
        // $ignoreable_exception_messages[] = 'The refresh token is invalid.';
        $ignoreable_exception_messages[] = 'The resource owner or authorization server denied the request.';

        if (app()->bound('sentry') && $this->shouldReport($e)) {
            if (!in_array($e->getMessage(), $ignoreable_exception_messages)) {
                app('sentry')->captureException($e);
            }
        }

        parent::report($e);
    }


    /**
     * @param $request
     * @param Exception|Throwable $e
     * @return Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Exception|Throwable $e): Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        // For every http 404 errors (web routes), redirect to the home page where the Vue app resides!
        /*if ($e instanceof NotFoundHttpException) {
            return redirect()->guest('/');
        }*/

        if ($e instanceof ValidationException) {

            return $this->apiResponse(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'errors' => $e->errors(),
                ],
                422
            );
        }

        // This is the error handling for the api routes
        if ($request->expectsJson()) {
            if ($e instanceof PostTooLargeException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => "Size of attached file should be less " . ini_get("upload_max_filesize") . "B",
                    ],
                    400
                );
            }

            if ($e instanceof AuthorizationException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Forbidden',
                    ],
                    403
                );
            }

            if ($e instanceof AuthenticationException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Unauthenticated or Token Expired, Please Login',
                    ],
                    401
                );
            }

            if ($e instanceof ThrottleRequestsException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Too Many Requests,Please Slow Down',
                    ],
                    429
                );
            }

            if ($e instanceof ModelNotFoundException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Entry for ' . str_replace('App\\', '', $e->getModel()) . ' not found',
                    ],
                    404
                );
            }

            if ($e instanceof ValidationException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => $e->getMessage(),
                        'errors' => $e->errors(),
                    ],
                    422
                );
            }

            if ($e instanceof QueryException) {

                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'There was Issue with the Query',
                        'exception' => $e,

                    ],
                    500
                );
            }

            /* if ($exception instanceof HttpResponseException) {
                 // $exception = $exception->getResponse();
                 return $this->apiResponse(
                    [
                         'success' => false,
                         'message' => "There was some internal error",
                         'exception'  => $exception
                     ],
                     500
                 );
            }*/

            if ($e instanceof \Error) {
                // $exception = $exception->getResponse();
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => "There was some internal error",
                        'exception' => $e,
                    ],
                    500
                );
            }
        }

        return parent::render($request, $e);

    }
}
