<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\CanGivePoints;
use App\Wise\Client\Enums\Metric;
use Illuminate\Contracts\Support\Arrayable;

readonly abstract class Boss implements Arrayable, CanGivePoints
{
    public function __construct(
        public Metric $metric,
        public int $kills,
        public int $rank,
        public float $ehb,
    ){
    }

    public function getAmount(): int
    {
        return $this->kills;
    }

    public function getMetric(): string
    {
        return $this->metric->value;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
