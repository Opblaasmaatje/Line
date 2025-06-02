<?php

namespace App\Wise\Client\Players\DTO\Snapshot\Bosses;

use App\Wise\Client\Players\DTO\Snapshot\CanGivePoints;
use Illuminate\Contracts\Support\Arrayable;

readonly abstract class Boss implements Arrayable, CanGivePoints
{
    public function __construct(
        public string $metric,
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
        return $this->metric;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
