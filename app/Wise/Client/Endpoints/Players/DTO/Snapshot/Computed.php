<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Computed\EfficientHoursBossed;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Computed\EfficientHoursPlayed;

readonly class Computed extends Basket
{
    public function __construct(
        public EfficientHoursPlayed $ehp,
        public EfficientHoursBossed $ehb,
    ) {
    }
}
