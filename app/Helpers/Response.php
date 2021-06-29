<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Contracts\Validation\Validator;

class Response extends HttpResponse
{

    public static function error(string $message = "There has been a error.", string $status = "error", $code = self::HTTP_BAD_REQUEST, array $headers = [])
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code, $headers);
    }

    public static function success($data = [], $message = 'Action done', $code = self::HTTP_OK, array $headers = [])
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code, $headers);
    }

    public static function successMessage(string $message, $code = self::HTTP_OK, array $headers = [])
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], $code, $headers);
    }

    public static function forbidden(string $message = "Forbidden", $status = 'unauthorized', $code = self::HTTP_FORBIDDEN, array $headers = [])
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code, $headers);
    }

    public static function custom($data, $status, $code = self::HTTP_OK, array $headers = [])
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
        ], $code, $headers);
    }

    public static function notFound()
    {
        return response()->json([
            'status' => "not_found",
            'message' => "Requested page not found",
        ], 404, []);
    }

    public static function validation(Validator $data, $status = "validation_error", $code = self::HTTP_UNPROCESSABLE_ENTITY, array $headers = [])
    {
        return response()->json([
            'status' => $status,
            'data' => $data->errors()->all(),
        ], $code, $headers);
    }
}
