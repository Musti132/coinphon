<?php

namespace App\Helpers;

Class Response {

    public static function success(array $data = [], $status = 200, array $headers = []){
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], $status, $headers);
    }

    public static function error(string $message = "There has been a error.", $status = 400, array $headers = []){
        return response()->json([
            'status' => 'fail',
            'message' => $message,
        ], $status, $headers);
    }

    public static function forbidden(string $message = "Forbidden", $status = 403, array $headers = []){
        return response()->json([
            'status' => 'fail',
            'message' => $message,
        ], $status, $headers);
    }
}

?>