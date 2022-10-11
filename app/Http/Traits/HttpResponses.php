<?php

namespace App\Http\Trai;

trait HttpResponses
{
    protected function success($message = null, $data, $code)
    {
        return response()->json([
            'status' => "Reqeust was successful",
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message = null, $data, $code)
    {
        return response()->json([
            'status' => "Error has occurred",
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
