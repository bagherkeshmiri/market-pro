<?php

use Illuminate\Http\JsonResponse;

function responseSuccess(array $data = [], $statusCode = 200): JsonResponse
{
    $result = [
        'status' => true,
    ];

    foreach ($data as $key => $value) {
        $result[$key] = $value;
    }

    return response()->json($result, $statusCode);
}

function responseError(array $data = [], $statusCode = 200): JsonResponse
{
    $result = [
        'status' => false,
    ];

    foreach ($data as $key => $value) {
        $result[$key] = $value;
    }

    return response()->json($result, $statusCode);
}
