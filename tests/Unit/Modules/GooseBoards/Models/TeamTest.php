<?php

namespace Tests\Unit\Modules\GooseBoards\Models;

use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TileFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class TeamTest extends ApplicationCase
{
    public static function positiones(): array
    {
        return [
            [1],
            [2],
            [3],
            [4],
        ];
    }

    #[Test]
    #[DataProvider('positiones')]
    public function team_can_get_current_objective_based_on_position(int $position)
    {
        $team = TeamFactory::new()
            ->for(
                GooseBoardFactory::new()
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
            )
            ->create([
                'position' => $position,
            ]);

        $this->assertModelExists($team->objective);
        $this->assertSame($position, $team->objective->position);
    }

    #[Test]
    public function it_resets_the_position_to_the_first_lower_position_when_objective_is_not_found()
    {
        $this->markTestSkipped('Hopefully this will not happen.');

        $team = TeamFactory::new()
            ->for(
                GooseBoardFactory::new()
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())

            )
            ->create([
                'position' => 8,
            ]);

        $this->assertModelExists($team->objective);
        $this->assertSame(6, $team->objective->position);
    }

    #[Test]
    public function it_can_get_the_current_position()
    {
        $team = TeamFactory::new()
            ->for(
                GooseBoardFactory::new()
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
            )
            ->create([
                'position' => 4,
            ]);

        $this->assertEquals('4/5', $team->current_position);
    }
}
