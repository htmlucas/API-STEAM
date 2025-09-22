<?php

namespace App\Domain\Steam\Exceptions;

use Exception;
use Throwable;

class SteamApiException extends Exception
{
    public function __construct(
        string $message = "Steam API error",
        int $code = 0,
        public readonly ?array $response = null, // JSON cru de erro (se disponível)
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
