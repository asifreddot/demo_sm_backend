<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;

class ResponseUtils
{
    public static function message($data = null, $message = null, $statusCode = 200): JsonResponse
    {
        $response = [
            'status' => $statusCode,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($response, $statusCode);
    }

}
