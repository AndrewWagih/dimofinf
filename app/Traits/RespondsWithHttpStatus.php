<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait RespondsWithHttpStatus
{
    protected function success($message, $data = [], $status = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function successWithPaginate($message, $data = [], $status = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data['data'],
            'links' => $data['links']??null,
            'meta' => $data['meta']??null,
            'message' => $message,
        ], $status);
    }

    protected function notFound($message, $data = [], $status =  Response::HTTP_NOT_FOUND)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }


   

    protected function failure($message, $status = Response::HTTP_BAD_REQUEST)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    protected function validationFailure($errors, $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response([
            'message' => "The given data was invalid.",
            "errors" => $errors
        ], $status);
    }
}
