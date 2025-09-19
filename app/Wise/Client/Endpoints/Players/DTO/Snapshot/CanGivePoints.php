<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot;

interface CanGivePoints
{
    public function getAmount(): int;

    public function getMetric(): string;
}
