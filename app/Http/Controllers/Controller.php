<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @param mixed $result
     * @param string $message
     * @return JsonResponse
     */
    public function handleResponse(mixed $result, string $message): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response);
    }

    /**
     * return error response.
     */
    public function handleError(string $message, int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'error' => $message,
        ];

        return response()->json($response, $code);
    }
}
