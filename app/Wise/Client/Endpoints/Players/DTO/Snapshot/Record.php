<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot;

use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Enums\Period;

readonly class Record
{
    public function __construct(
        public int $playerId,
          public Period $period,
          public Metric $metric,
          public float $value,
          public string $updatedAt,
    ) {
    }
}
