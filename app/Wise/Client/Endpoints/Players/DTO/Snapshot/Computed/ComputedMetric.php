<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot\Computed;

use Illuminate\Contracts\Support\Arrayable;

readonly abstract class ComputedMetric implements Arrayable
{
    public function __construct(
        public string $metric,
        public float $value,
        public int $rank,
    ){
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
