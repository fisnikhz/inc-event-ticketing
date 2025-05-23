<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait APIResponse
{
    public function respondWithSuccess($data = [], $message = null, $statusCode = 200): JsonResponse
    {
        $response = [
            'message' => $message ?? "Success",
            'status_code' => $statusCode,
        ];

        if ($data instanceof LengthAwarePaginator) {
            $response['data'] = $data->items();
            $response['pagination'] = $this->paginator($data);
        } else {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    public function respondWithError($errors = [], $message = null, $statusCode = 400): JsonResponse
    {
        $response = [
            'errors' => $errors,
            'message' => $message ?? "Error",
            'success' => false,
            'status_code' => $statusCode,
        ];

        return response()->json($response, $statusCode);
    }
}
