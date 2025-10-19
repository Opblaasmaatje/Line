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
    public static function indexes(): array
    {
        return [
            [1],
            [2],
            [3],
            [4],
        ];
    }

    #[Test]
    #[DataProvider('indexes')]
    public function team_can_get_current_objective_based_on_index($index)
    {
        $team = TeamFactory::new()
            ->for(
                GooseBoardFactory::new()
                    ->has(TileFactory::new(['index' => 0]))
                    ->has(TileFactory::new(['index' => 1]))
                    ->has(TileFactory::new(['index' => 2]))
                    ->has(TileFactory::new(['index' => 3]))
                    ->has(TileFactory::new(['index' => 4]))
            )
            ->create(['position' => $index]);

        $this->assertModelExists($team->objective);
        $this->assertSame($index, $team->objective->index);
    }

    #[Test]
    public function it_resets_the_index_to_the_first_lower_index_when_objective_is_not_found()
    {
        $this->markTestSkipped('Hopefully this will not happen.');

        $team = TeamFactory::new()
            ->for(
                GooseBoardFactory::new()
                    ->has(TileFactory::new(['index' => 0]))
                    ->has(TileFactory::new(['index' => 1]))
                    ->has(TileFactory::new(['index' => 2]))
                    ->has(TileFactory::new(['index' => 3]))
                    ->has(TileFactory::new(['index' => 4]))
                    ->has(TileFactory::new(['index' => 5]))
                    ->has(TileFactory::new(['index' => 6]))
                    ->has(TileFactory::new(['index' => 9]))
                    ->has(TileFactory::new(['index' => 10]))

            )
            ->create(['position' => 8]);

        $this->assertModelExists($team->objective);
        $this->assertSame(6, $team->objective->index);
    }
}
