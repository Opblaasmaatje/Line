<?php

namespace App\Wise\Client\Endpoints\Competition\DTO;

readonly class History
{
    public function __construct(
        public int $value,
        public string $date,
    ){
    }
}
