<?php

namespace App\Points\Configuration;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Boss;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\CanGivePoints;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Skills\Skill;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * todo find a way to rework this to be cleaner
 */
class PointAllocationConfiguration
{
    public function __construct(
        protected array $bossConfig = [],
        protected array $skillConfig = [],
    ) {
        $this->bossConfig = Arr::where(
            array: $this->bossConfig,
            callback: fn ($entry) => Arr::has($entry, ['per', 'give'])
        );

        $this->skillConfig = Arr::where(
            array: $this->skillConfig,
            callback: fn ($entry) => Arr::has($entry, ['per', 'give'])
        );
    }

    protected function forBoss(Boss $boss): PointCalculator
    {
        $bossConfig = Arr::get(
            array: $this->bossConfig,
            key: $boss::class,
            default: $this->bossConfig[Boss::class]
        );

        return new PointCalculator(
            per: $bossConfig['per'],
            give: (float) $bossConfig['give']
        );
    }

    protected function forSkill(Skill $skill): PointCalculator
    {
        $skillConfig = Arr::get(
            array: $this->skillConfig,
            key: $skill::class,
            default: $this->skillConfig[Skill::class]
        );

        return new PointCalculator(
            per: $skillConfig['per'],
            give: (float) $skillConfig['give']
        );
    }

    public function factory(CanGivePoints $canGivePoints): PointCalculator
    {
        return match (true) {
            $canGivePoints instanceof Boss => $this->forBoss($canGivePoints),
            $canGivePoints instanceof Skill => $this->forSkill($canGivePoints),
            default => throw new InvalidArgumentException(),
        };
    }
}
