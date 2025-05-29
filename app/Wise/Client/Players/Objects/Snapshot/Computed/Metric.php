<?php

namespace App\Wise\Client\Players\Objects\Snapshot\Computed;

readonly abstract class Metric
{
    public function __construct(
        public string $metric,
        public float $value,
        public int $rank,
    ){
    }
}
