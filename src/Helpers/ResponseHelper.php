<?php

use FAT\Helper\Accessors\MethodResponse;
use Illuminate\Http\JsonResponse;

if (!function_exists("jsonResponse")) {

    function jsonResponse(bool $status, string $message, $data = [], string $code = "") {

        if (!($data instanceof \Illuminate\Database\Eloquent\Collection) && !($data instanceof \Illuminate\Support\Collection) && !is_array($data) && !is_iterable($data) && !($data instanceof \Illuminate\Database\Eloquent\Model)) {
            $data = null;
        }

        return response()->json([
                    "status" => $status,
                    "message" => $message,
                    "data" => $data,
                    "code" => $code
        ]);
    }

}

if (!function_exists("methodResp")) {

    function methodResp(bool $status, string $message, $data = [], string $code = ""): MethodResponse {

        if (!($data instanceof \Illuminate\Database\Eloquent\Collection) && !($data instanceof \Illuminate\Support\Collection) && !is_array($data) && !is_iterable($data) && !($data instanceof \Illuminate\Database\Eloquent\Model)) {
            $data = null;
        }

        $methodResponse = new MethodResponse();

        $methodResponse->setStatus($status);
        $methodResponse->setMessage($message);
        $methodResponse->setData($data);
        $methodResponse->setCode($code);

        return $methodResponse;
    }

}

if (!function_exists("parseMethodToJsonResponse")) {

    function parseMethodToJsonResponse(MethodResponse $methodResp): JsonResponse {

        return jsonResponse($methodResp->getStatus(), $methodResp->getMessage(), $methodResp->getData(), $methodResp->getCode());
    }

}