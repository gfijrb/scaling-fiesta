<?php


namespace App\Http\Responses;

/**
 * Class JsonResponse
 * @package App\Http\Responses
 */
class JsonResponse
{
    /**
     * @param mixed $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data, int $code=200)
    {
        return response()->json([
            'result' => $data
        ], $code);
    }

    /**
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function fail(string $msg, int$code=404)
    {
        return response()->json([
            'error' => $msg
        ], $code);
    }
}
