<?php

namespace App\Points\Configuration;

use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Skill;
use Illuminate\Support\Arr;

class PointAllocationConfiguration
{
    public function __construct(
        protected array $bossConfig = [],
        protected array $skillConfig = [],
    ) {

        $this->bossConfig = Arr::where(
            array: $this->bossConfig,
            callback: fn($entry) => Arr::has($entry, ['per', 'give'])
        );

        $this->skillConfig = Arr::where(
            array: $this->skillConfig,
            callback: fn($entry) => Arr::has($entry, ['per', 'give'])
        );
    }

    public function forBoss(Boss $boss): PointCalculator
    {
        $bossConfig = Arr::get(
            array: $this->bossConfig,
            key: $boss::class,
            default: $this->bossConfig[Boss::class]
        );

        return new PointCalculator(
            per: (float) $bossConfig['per'],
            give: $bossConfig['give']
        );
    }

    public function forSkill(Skill $skill): PointCalculator
    {
        $skillConfig = Arr::get(
            array: $this->skillConfig,
            key: $skill::class,
            default: $this->skillConfig[Skill::class]
        );

        return new PointCalculator(
            per: (float) $skillConfig['per'],
            give: $skillConfig['give']
        );
    }
}
