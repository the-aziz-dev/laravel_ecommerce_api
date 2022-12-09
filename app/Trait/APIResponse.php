<?php

namespace App\Trait;

use Illuminate\Http\JsonResponse;

trait APIResponse
{
    protected static function successResponse($statusCode, $data): JsonResponse
    {
        return response()->json([
            'status' => 'successful',
            'results' => $data,
        ], $statusCode);
    }

    protected static function failResponse($statusCode): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
        ], $statusCode);
    }
}
