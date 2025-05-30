<?php

namespace App\Points\Configuration;

use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use Illuminate\Support\Arr;

class BossPointAllocation
{
    public function __construct(
        protected array $config
    ) {
        //
    }

    public function forBoss(Boss $boss): PointCalculator
    {
        $bossSpecific = Arr::get(
            array: $this->config,
            key: $boss::class,
            default: $this->config['default']
        );

        return new PointCalculator(
            per: (float) $bossSpecific['per'],
            give: $bossSpecific['give']
        );
    }
}
