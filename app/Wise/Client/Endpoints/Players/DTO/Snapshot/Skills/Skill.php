<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot\Skills;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\CanGivePoints;
use App\Wise\Client\Enums\Metric;
use Illuminate\Contracts\Support\Arrayable;

abstract readonly class Skill implements Arrayable, CanGivePoints
{
    public function __construct(
        public Metric $metric,
        public int $experience,
        public int $rank,
        public int $level,
        public float $ehp,
    ) {
    }

    public function getAmount(): int
    {
        return $this->experience;
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
