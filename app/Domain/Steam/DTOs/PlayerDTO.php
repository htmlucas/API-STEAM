<?php

namespace App\Domain\Steam\DTOs;

final class PlayerDTO 
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $avatar
    ) 
    {
    }
}