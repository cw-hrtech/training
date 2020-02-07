<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    protected function success($data)
    {
        return response()->json([
            'data' => $data,
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    protected function error($message, $code = Response::HTTP_NOT_FOUND)
    {
        return response()->json([
            'message' => $message,
            'status' => $code
        ], $code);
    }
}
