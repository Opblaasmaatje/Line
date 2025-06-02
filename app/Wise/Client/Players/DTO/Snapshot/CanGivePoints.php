<?php

namespace App\Wise\Client\Players\DTO\Snapshot;

interface CanGivePoints
{
    public function getAmount(): int;

    public function getMetric(): string;
}
