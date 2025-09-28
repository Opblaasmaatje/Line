<?php

namespace App\Wise\Client\Endpoints\Competition\DTO\Competition;

use App\Wise\Client\Enums\Metric;

readonly class CompetitionObject
{
    public function __construct(
        public int $id,
        public string $title,
        public Metric $metric, //perhaps cast to enum
        public string $type,
        public string $startsAt,
        public string $endsAt,
    ) {
    }
}
