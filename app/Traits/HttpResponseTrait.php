<?php

namespace App\Traits;

trait HttpResponseTrait
{
    public function success(string $message = "Success!", $data = null)
    {
        return response()->json(["message" => $message, "data" => $data, "code" => 200], 200);
    }

    public function badRequest(string $message = "Bad request!", $data = null)
    {
        return response()->json(['message' => $message, "data" => $data, "code" => 400], 400);
    }
    public function notFound(string $message = "Not found!", $data = null)
    {
        return response()->json(['message' => $message, "data" => $data, "code" => 404], 404);
    }

    public function unauthorized(string $message = "Unauthorized!", $data = null)
    {
        return response()->json(['message' => $message, "data" => $data, "code" => 401], 401);
    }
    public function forbidden(string $message = "Forbidden!", $data = null)
    {
        return response()->json(['message' => $message, "data" => $data, "code" => 403], 403);
    }
    public function serverError(string $message = "Server Error", $data = null)
    {
        return response()->json(['message' => $message, "data" => $data, "code" => 500], 500);
    }
    
}
