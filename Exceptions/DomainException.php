<?php

namespace Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class DomainException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage()
        ]);
    }
}
