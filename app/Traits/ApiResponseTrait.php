<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function returnSuccessResponse($data, $code)
    {
        return response()->json(['data' => $data], $code);
    }

    public function returnErrorResponse($message, $code)
    {
        return response()->json(['message' => $message], $code);
    }
}
