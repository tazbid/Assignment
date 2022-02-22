<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    /**
     * return customize response.
     *
     * @param array $result
     * @param  string $message
     * @param  int  $code
     *
     * @return JsonResponse
     */

    public function sendSuccessResponse($result = [], $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        if (empty($result)) {
            unset($response['data']);
        }

       // return new JsonResponse($response, $code);
        return response()->json($response, $code);
    }
}
