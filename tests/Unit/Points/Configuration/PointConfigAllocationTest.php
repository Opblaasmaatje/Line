<?php

namespace Tests\Unit\Points\Configuration;

use App\Points\Configuration\PointAllocationConfiguration;
use App\Points\Configuration\PointCalculator;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\AlchemicalHydra;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Araxxor;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Boss;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\CommanderZilyana;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\SolHeredit;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheatreOfBlood;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Skills\Runecrafting;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Skills\Skill;
use App\Wise\Client\Enums\Metric;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class PointConfigAllocationTest extends ApplicationCase
{
    #[Test]
    public function boss_point_allocation_can_map_to_point_calculator_and_give_points()
    {
        $boss = new CommanderZilyana(
            metric: Metric::COMMANDER_ZILYANA,
            kills: 20,
            rank: 2,
            ehb: 2,
        );

        $config = new PointAllocationConfiguration([
            CommanderZilyana::class => [
                'per' => 10,
                'give' => 4,
            ],
            Boss::class => [
                'per' => 1,
                'give' => 20,
            ],
        ]);

        $pointCalculator = $config->factory($boss);

        $this->assertSame(
            8,
            $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function boss_point_allocation_can_use_the_default_and_give_an_correct_amount_of_points()
    {
        $boss = new AlchemicalHydra(
            metric: Metric::ALCHEMICAL_HYDRA,
            kills: 100,
            rank: 2,
            ehb: 2,
        );

        $config = new PointAllocationConfiguration([
            Boss::class => [
                'per' => 1,
                'give' => 20,
            ],
        ]);

        $pointCalculator = $config->factory($boss);

        $this->assertSame(
            2000,
            $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function it_accepts_float_values()
    {
        $boss = new TheatreOfBlood(
            metric: Metric::THEATRE_OF_BLOOD,
            kills: 2,
            rank: 2,
            ehb: 2,
        );

        $config = new PointAllocationConfiguration([
            Boss::class => [
                'per' => 1,
                'give' => 0.5,
            ],
        ]);

        $pointCalculator = $config->factory($boss);

        $this->assertSame(
            1,
            $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function it_does_not_break_when_not_having_anything_to_calculate_with()
    {
        $boss = new Araxxor(
            metric: Metric::ARAXXOR,
            kills: 0,
            rank: 2,
            ehb: 2,
        );

        $config = new PointAllocationConfiguration([
            Boss::class => [
                'per' => 2,
                'give' => 5,
            ],
        ]);

        $pointCalculator = $config->factory($boss);

        $this->assertSame(
            0,
            $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function it_defaults_when_it_has_a_key_but_no_values_are_set()
    {
        $boss = new SolHeredit(
            metric: Metric::SOL_HEREDIT,
            kills: 2,
            rank: 2,
            ehb: 2,
        );

        $config = new PointAllocationConfiguration([
            SolHeredit::class => [],
            Boss::class => [
                'per' => 1,
                'give' => 2,
            ],
        ]);

        $pointCalculator = $config->factory($boss);

        $this->assertSame(
            4,
            $pointCalculator->calculate($boss->kills)
        );
    }

    #[Test]
    public function it_returns_point_calculator_for_skills()
    {
        $runecrafting = new Runecrafting(
            metric: Metric::RUNECRAFTING,
            experience: 1,
            rank: 1,
            level: 1,
            ehp: 1,
        );

        $config = new PointAllocationConfiguration(skillConfig: [
            Skill::class => [
                'per' => 1,
                'give' => 2,
            ],
        ]);

        $this->assertInstanceOf(
            PointCalculator::class,
            $config->factory($runecrafting)
        );
    }
}
