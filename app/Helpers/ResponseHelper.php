<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResponseHelper
{
    /**
     * @param array|object|string $result
     * @param string $status
     * @param int $statusCode
     * @param array $errors
     * @param array $headers
     *
     * @return JsonResponse
     */
    public static function send(
        $result = [],
        string $status = Status::OK,
        int $statusCode = Response::HTTP_OK,
        array $errors = [],
        array $headers = []
    ): JsonResponse
    {
        $data = [];
        $data['status'] = $status;
        if ($result) {
            $data['results'] = $result;
        }
        if ($errors) {
            $data['errors'] = $errors;
        }

        return response()->json(
            $data,
            $statusCode,
            $headers,
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * @param string|Exception $exception_message
     * @return JsonResponse
     */
    public static function sendException($exception_message): JsonResponse
    {
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        if ($exception_message instanceof NotFoundHttpException) {
            $statusCode = Response::HTTP_NOT_FOUND;
        }
        if (
            $exception_message instanceof HttpException &&
            $exception_message->getStatusCode() === Response::HTTP_FORBIDDEN
        ) {
            $statusCode = Response::HTTP_FORBIDDEN;
        }
        if ($exception_message instanceof Exception) {
            $exception_message = $exception_message->getMessage();
        }

        return self::send(
            [],
            Status::NG,
            $statusCode,
            ['server' => $exception_message]
        );
    }
}
