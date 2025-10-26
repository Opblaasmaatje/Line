<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\TeamService;

use App\Modules\GooseBoards\Library\Services\TeamService;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TileFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class SetPositionTest extends ApplicationCase
{
    #[Test]
    public function it_sets_position()
    {
        $team = TeamFactory::new()
            ->for(
                GooseBoardFactory::new()
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
            )
            ->create();

        $outCome = $this->subjectUnderTesting()->setPosition($team, 2);

        $this->assertEquals(2, $outCome->position);
    }

    #[Test]
    public function it_does_not_go_over_limit()
    {
        $team = TeamFactory::new()
            ->for(
                GooseBoardFactory::new()
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
                    ->has(TileFactory::new())
            )
            ->create();

        $outCome = $this->subjectUnderTesting()->setPosition($team, 10);

        $this->assertEquals(3, $outCome->position);
    }

    protected function subjectUnderTesting()
    {
        return $this->app->make(TeamService::class);
    }
}
