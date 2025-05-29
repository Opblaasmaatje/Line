<?php

namespace App\Wise\Client\Players\Objects\Snapshot;

use App\Wise\Client\Players\Objects\Snapshot\Computed\EfficientHoursBossed;
use App\Wise\Client\Players\Objects\Snapshot\Computed\EfficientHoursPlayed;

readonly class Computed
{
    public function __construct(
        public EfficientHoursPlayed $ehp,
        public EfficientHoursBossed $ehb,
    ){
    }
}
