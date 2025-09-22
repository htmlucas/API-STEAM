<?php

namespace App\Domain\Steam\DTOs;

final class GameDTO 
{
    public function __construct(
        public int $appId,
        public string $name,
        public int $playtimeMinutes
    ) 
    {
    }
}