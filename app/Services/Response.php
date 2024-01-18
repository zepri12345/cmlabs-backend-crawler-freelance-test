<?php

namespace App\Services;

class Response
{
    const SUCCESS = true;
    const FAIL = false;

    public static function notFoundErrorJson($message = 'Not Found', $statusCode = 404)
    {
        return response()->json([
            'success' => self::FAIL,
            'message' => $message
        ], $statusCode);
    }

    public static function badRequestErrorJson($message = 'Bad Request', $data = null, $statusCode = 400)
    {
        $response['success'] = self::FAIL;
        $response['message'] = $message;
        if ($data) {
            $response['error'] = $data;
        }
        return response()->json($response, $statusCode);
    }

    public static function unauthorizedErrorJson($message = 'Unauthorized', $statusCode = 401)
    {
        return response()->json([
            'success' => self::FAIL,
            'message' => $message
        ], $statusCode);
    }

    public static function conflictErrorJson($message = 'Data already exist', $statusCode = 409)
    {
        return response()->json([
            'success' => self::FAIL,
            'message' => $message
        ], $statusCode);
    }

    public static function internalServerErrorJson($message = 'Internal Server Error', $error, $statusCode = 500)
    {
        return response()->json([
            'success' => self::FAIL,
            'message' => $message,
            'error' => $error
        ], $statusCode);
    }

    public static function successJson($message = 'Request Success', $data = null, $statusCode = 200)
    {
        $response['success'] = self::SUCCESS;
        $response['message'] = $message;
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, $statusCode);
    }

    // returned data value

    public static function notFoundError($message = 'Not Found', $statusCode = 404)
    {
        return [
            'status' => $statusCode,
            'success' => self::FAIL,
            'message' => $message
        ];
    }

    public static function badRequestError($message = 'Bad Request', $data = null, $statusCode = 400)
    {
        $response = [
            'status' => $statusCode,
            'success' => self::FAIL,
            'message' => $message,
        ];
        if ($data) {
            $response['error'] = $data;
        }
    }

    public static function unauthorizedError($message = 'Unauthorized', $statusCode = 401)
    {
        return [
            'status' => $statusCode,
            'success' => self::FAIL,
            'message' => $message,
        ];
    }

    public static function conflictError($message = 'Data already exist', $statusCode = 409)
    {
        return [
            'status' => $statusCode,
            'success' => self::FAIL,
            'message' => $message,
        ];
    }

    public static function internalServerError($message = 'Internal Server Error', $error, $statusCode = 500)
    {
        return [
            'status' => $statusCode,
            'success' => self::FAIL,
            'message' => $message,
            'error' => $error
        ];
    }

    public static function success($message = 'Request Success', $data = null, $statusCode = 200)
    {
        $response = [
            'status' => $statusCode,
            'success' => self::SUCCESS,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }
        return $response;
    }
}

