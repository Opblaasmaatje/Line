<?php

namespace Tests\Unit\Points\Configuration;

use App\Points\Configuration\BossPointAllocation;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\AlchemicalHydra;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Araxxor;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\CommanderZilyana;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheatreOfBlood;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class BossPointAllocationConfigTest extends ApplicationCase
{
    #[Test]
    public function boss_point_allocation_can_map_to_point_calculator_and_give_points()
    {
        $boss = new CommanderZilyana(
            metric: 'Commander Zilyana',
            kills: 20,
            rank: 2,
            ehb: 2,
        );

        $config = new BossPointAllocation([
            CommanderZilyana::class => [
                'per' => 10,
                'give' => 4,
            ],
            'default' => [
                //
            ],
        ]);

        $pointCalculator = $config->forBoss($boss);

        $this->assertSame(
            expected: 8,
            actual: $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function boss_point_allocation_can_use_the_default_and_give_an_correct_amount_of_points()
    {
        $boss = new AlchemicalHydra(
            metric: 'Alchemical Hydra',
            kills: 100,
            rank: 2,
            ehb: 2,
        );

        $config = new BossPointAllocation([
            'default' => [
                'per' => 1,
                'give' => 20
            ],
        ]);

        $pointCalculator = $config->forBoss($boss);

        $this->assertSame(
            expected: 2000,
            actual: $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function it_accepts_float_values()
    {
        $boss = new TheatreOfBlood(
            metric: 'Theatre of blood',
            kills: 2,
            rank: 2,
            ehb: 2,
        );

        $config = new BossPointAllocation([
            'default' => [
                'per' =>  1,
                'give' => 0.5
            ],
        ]);

        $pointCalculator = $config->forBoss($boss);

        $this->assertSame(
            expected: 1,
            actual: $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function it_does_not_break_when_not_having_anything_to_calculate_with()
    {
        $boss = new Araxxor(
            metric: 'Araxxor',
            kills: 0,
            rank: 2,
            ehb: 2,
        );

        $config = new BossPointAllocation([
            'default' => [
                'per' =>  2,
                'give' => 5
            ],
        ]);

        $pointCalculator = $config->forBoss($boss);

        $this->assertSame(
            expected: 0,
            actual: $pointCalculator->calculate($boss->kills)
        );
    }
}
