<?php

namespace App\Points\Configuration;

class PointCalculator
{
    public function __construct(
        protected int $per,
        protected float $give,
    ) {
    }


    public function calculate(int $hasAmountOf): int
    {
        return rescue(function () use ($hasAmountOf) {
            $amount = floor($hasAmountOf / $this->per);

            return (int)max(
                floor($this->give * $amount),
                0,
            );
        }, 0);
    }
}
