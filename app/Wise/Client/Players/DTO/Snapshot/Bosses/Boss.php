<?php

namespace App\Wise\Client\Players\DTO\Snapshot\Bosses;

use Illuminate\Contracts\Support\Arrayable;

readonly abstract class Boss implements Arrayable
{
    public function __construct(
        public string $metric,
        public int $kills,
        public int $rank,
        public float $ehb,
    ){
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
