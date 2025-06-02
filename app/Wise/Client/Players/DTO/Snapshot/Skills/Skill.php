<?php

namespace App\Wise\Client\Players\DTO\Snapshot\Skills;

readonly abstract class Skill
{
    public function __construct(
        public string $metric,
        public int $experience,
        public int $rank,
        public int $level,
        public float $ehp,
    ){
    }
}
