<?php

namespace App\Trait;

use Illuminate\Http\JsonResponse;

trait APIResponse
{
    protected static function successResponse($statusCode, $message, $data): JsonResponse
    {
        return response()->json([
            'status' => 'successful',
            'message' => $message,
            'results' => $data,
        ], $statusCode);

    }

    protected static function failResponse($statusCode, $message): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => $message,
        ], $statusCode);
    }
}
