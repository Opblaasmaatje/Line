<?php

namespace App\Wise\Client\Endpoints\Competition\DTO\Competition;

readonly class CompetitionObject
{
    public function __construct(
        public int $id,
        public string $title,
        public string $metric, //perhaps cast to enum
        public string $type,
        public string $startsAt,
        public string $endsAt,
    ){
    }
}
