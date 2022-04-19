<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array|null $data
     * @param int $responseCode
     *
     * @return JsonResponse
     */
    public function response(
        ?array $data,
        int $responseCode = Response::HTTP_OK
    ): JsonResponse
    {
        return response()->json([
            'data' => $data
        ], $responseCode);
    }
}
