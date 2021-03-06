<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response as HttpResponse;

Class Response extends HttpResponse{
    
    public const HTTP_SUCCESS = 200;
    public const HTTP_ERROR = 400;

    public static function error(string $message = "There has been a error.", $code = self::HTTP_ERROR, array $headers = []){
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code, $headers);
    }

    public static function success(array $data = [], $code = self::HTTP_SUCCESS, array $headers = []){
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], $code, $headers);
    }

    public static function successMessage(string $message, $code = self::HTTP_SUCCESS, array $headers = []){
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], $code, $headers);
    }

    public static function forbidden(string $message = "Forbidden", $code = self::HTTP_FORBIDDEN, array $headers = []){
        return response()->json([
            'status' => 'unauthorized',
            'message' => $message,
        ], $code, $headers);
    }
}

?>