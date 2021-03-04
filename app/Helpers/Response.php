<?php

namespace App\Helpers;

Class Response {

    public const HTTP_FORBIDDEN = 403;
    public const HTTP_SUCCESS = 200;
    public const HTTP_ERROR = 400;

    public static function error(string $message = "There has been a error.", $status = self::HTTP_ERROR, array $headers = []){
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $status, $headers);
    }

    public static function success(array $data = [], $status = self::HTTP_SUCCESS, array $headers = []){
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], $status, $headers);
    }

    public static function forbidden(string $message = "Forbidden", $status = self::HTTP_FORBIDDEN, array $headers = []){
        return response()->json([
            'status' => 'fail',
            'message' => $message,
        ], $status, $headers);
    }
}

?>