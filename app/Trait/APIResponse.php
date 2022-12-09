<?php

namespace App\Trait;

use Illuminate\Http\JsonResponse;

trait APIResponse
{
    protected static function successResponse($statusCode, $data): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'message' => 'Successful',
            'results' => $data,
        ], $statusCode);
    }

    protected static function failResponse($statusCode, $message): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }
}
