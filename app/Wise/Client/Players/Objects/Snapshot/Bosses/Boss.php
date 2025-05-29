<?php

namespace App\Wise\Client\Players\Objects\Snapshot\Bosses;

readonly abstract class Boss
{
    public function __construct(
        public string $metric,
        public int $kills,
        public int $rank,
        public float $ehb,
    ){
    }
}
