<?php

namespace App\Points\Configuration;

class PointCalculator
{
    public function __construct(
        protected int $per,
        protected float $give,
    ){
    }

    public function calculate(int $hasAmountOf): int
    {
        $amount = floor($hasAmountOf / $this->per);

        return $this->give * $amount;
    }
}
