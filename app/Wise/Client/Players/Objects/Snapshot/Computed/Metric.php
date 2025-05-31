<?php

namespace App\Wise\Client\Players\Objects\Snapshot\Computed;

use Illuminate\Contracts\Support\Arrayable;

readonly abstract class Metric implements Arrayable
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
