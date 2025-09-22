<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Domain\Steam\Exceptions\SteamApiException;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (SteamApiException $e, $request): JsonResponse {
            return response()->json([
                'type'   => 'https://example.com/probs/steam-api',
                'title'  => 'Steam API unavailable',
                'status' => 502,
                'detail' => $e->getMessage(),
                'extra'  => [
                    'status_code' => $e->getCode(),
                    'steam_response' => $e->response,
                ],
            ], 502);
        });
    }
}
