<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommonResponse {
    public static function notFoundResponse(): JsonResponse
    {
        return ResponseHelper::send(
            [],
            Status::NG,
            Response::HTTP_NOT_FOUND,
            ['error' => ErrorCodeHelper::NOT_FOUND]
        );
    }

    public static function existedResponse(): JsonResponse
    {
        return ResponseHelper::send(
            [],
            Status::NG,
            Response::HTTP_CONFLICT,
            ['error' => ErrorCodeHelper::EXISTED]
        );
    }

    public static function invalidResponse(): JsonResponse
    {
        return ResponseHelper::send(
            [],
            Status::NG,
            Response::HTTP_BAD_REQUEST,
            ['error' => ErrorCodeHelper::INVALID]
        );
    }

    public static function forbiddenResponse(): JsonResponse
    {
        return ResponseHelper::send(
            [],
            Status::NG,
            Response::HTTP_FORBIDDEN,
            ['error' => ErrorCodeHelper::NOT_ALLOW]
        );
    }

    public static function unknownResponse($e): JsonResponse
    {
        if (str_contains(strval($e), 'No query results')) {
            $e = 'Value is not found';
        }
        return ResponseHelper::send(["error" => $e], Status::NG);
    }
}
