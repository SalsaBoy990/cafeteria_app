<?php
/**
 * Uniformize API json responses trait
 */

namespace App\Http\Traits\Api;

use Error;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

trait ApiResponseTrait
{
    /**
     * Return resource
     *
     * @param JsonResource $resource
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function respondWithResource(
        JsonResource $resource,
                     $message = null,
        int          $statusCode = 200,
        array        $headers = []
    ): JsonResponse
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource
        return $this->apiResponse(
            [
                'success' => true,
                'result' => $resource,
                'message' => $message,
            ],
            $statusCode,
            $headers
        );
    }


    /**
     * Organize data into an uniform response structure
     *
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return array
     */
    public function parseGivenData(array $data = [], int $statusCode = 200, array $headers = []): array
    {
        $responseStructure = [
            'success' => $data['success'],
            'message' => $data['message'] ?? null,
            'result' => $data['result'] ?? null,
        ];
        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }
        if (isset($data['status'])) {
            $statusCode = $data['status'];
        }

        if (isset($data['exception']) && ($data['exception'] instanceof Error || $data['exception'] instanceof Exception)) {
            if (config('app.env') !== 'production') {
                // only add exception info to the response when not in production
                $responseStructure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace(),
                ];
            }

        }

        if ($data['success'] === false) {
            if (isset($data['error_code'])) {
                $responseStructure['error_code'] = $data['error_code'];
            } else {
                $responseStructure['error_code'] = 1;
            }
        }

        return ["content" => $responseStructure, "statusCode" => $statusCode, "headers" => $headers];
    }


    /**
     * Return structured json response with the given data.
     *
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function apiResponse(array $data = [], int $statusCode = 200, array $headers = []): JsonResponse
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        $result = $this->parseGivenData($data, $statusCode, $headers);

        return response()->json(
            $result['content'],
            intval($result['statusCode']),
            $result['headers']
        );
    }


    /**
     * Just a wrapper to put data to result
     *
     * @param ResourceCollection $resourceCollection
     * @param  ?string $message
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function respondWithResourceCollection(
        ResourceCollection $resourceCollection,
        ?string            $message = null,
        int                $statusCode = 200,
        array              $headers = []
    ): JsonResponse
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource
        return $this->apiResponse(
            [
                'success' => true,
                'result' => $resourceCollection->response()->getData(),
            ],
            $statusCode,
            $headers
        );
    }


    /**
     * Respond with success.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondSuccess(string $message = 'OK'): JsonResponse
    {
        return $this->apiResponse(['success' => true, 'message' => $message]);
    }


    /**
     * Respond with created.
     *
     * @param JsonResource $resource
     * @return JsonResponse
     */
    protected function respondCreated(JsonResource $resource): JsonResponse
    {
        return $this->apiResponse([
            'success' => true,
            'result' => $resource,
            'message' => 'OK',
        ], 201);
    }


    /**
     * Respond with deleted.
     *
     * @return JsonResponse
     */
    protected function respondDeleted(): JsonResponse
    {
        return $this->apiResponse(['success' => true, 'message' => 'OK'], 204);
    }


    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContent(string $message = 'No Content Found'): JsonResponse
    {
        return $this->apiResponse(['success' => false, 'message' => $message]);
    }


    /**
     * Respond with no content (empty resource).
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContentResource(string $message = 'No Content Found'): JsonResponse
    {
        return $this->respondWithResource(new JsonResource([]), $message);
    }


    /**
     * Respond with no content (empty resource collection).
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContentResourceCollection(string $message = 'No Content Found'): JsonResponse
    {
        return $this->respondWithResourceCollection(new ResourceCollection([]), $message);
    }


    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->respondError($message, 401);
    }


    /**
     * Respond with custom error.
     *
     * @param $message
     * @param int $statusCode
     *
     * @param Exception|null $exception
     * @param int|null $error_code
     *
     * @return JsonResponse
     */
    protected function respondError($message, int $statusCode = 400, Exception $exception = null, int $error_code = null): JsonResponse
    {

        return $this->apiResponse(
            [
                'success' => false,
                'message' => $message ?? 'There was an internal error, Please try again later',
                'exception' => $exception,
                'error_code' => $error_code,
            ],
            $statusCode
        );
    }


    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondForbidden(string $message = 'Forbidden'): JsonResponse
    {
        return $this->respondError($message, 403);
    }


    /**
     * Respond with not found.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNotFound(string $message = 'Not Found'): JsonResponse
    {
        return $this->respondError($message, 404);
    }


    // /**
    //  * Respond with failed login.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // protected function respondFailedLogin()
    // {
    //     return $this->apiResponse([
    //         'errors' => [
    //             'email or password' => 'is invalid',
    //         ]
    //     ], 422);
    // }


    /**
     * Respond with internal server error.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondInternalError(string $message = 'Internal Error'): JsonResponse
    {
        return $this->respondError($message, 500);
    }


    /**
     * Respond with validation errors (422)
     *
     * @param ValidationException $exception
     * @return JsonResponse
     */
    protected function respondValidationErrors(ValidationException $exception): JsonResponse
    {
        return $this->apiResponse(
            [
                'success' => false,
                'message' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ],
            422
        );
    }
}
