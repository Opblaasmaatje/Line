<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\GooseBoardService;

use App\Modules\GooseBoards\Library\Service\GooseBoardService;
use App\Modules\GooseBoards\Library\Service\Leaderboard\Ranking;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TileFactory;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class LeaderboardTest extends ApplicationCase
{
    #[Test]
    public function it_can_format_a_leaderboard()
    {
        $gooseBoard = GooseBoardFactory::new()
            ->has(TeamFactory::new()->position(2))
            ->has(TeamFactory::new()->position(5))
            ->has(TeamFactory::new()->position(2))
            ->has(TeamFactory::new()->position(1))
            ->has(TeamFactory::new()->position(4))
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->create();

         $leaderboard = $this->subjectUnderTesting()->leaderboard($gooseBoard);

        $this->assertEquals(
            [1, 2, 3, 4, 5],
            $leaderboard->teams->pluck('ranking')->toArray()
        );

        /** @var Ranking $firstPlace */
        $firstPlace = $leaderboard->teams->shift();
        $this->assertSame(':first_place:', $firstPlace->getIcon());
        $this->assertSame('5/5', $firstPlace->getPosition());

        /** @var Ranking $secondPlace */
        $secondPlace = $leaderboard->teams->shift();
        $this->assertSame(':second_place:', $secondPlace->getIcon());
        $this->assertSame('4/5', $secondPlace->getPosition());

        /** @var Ranking $thirdPlace */
        $thirdPlace = $leaderboard->teams->shift();
        $this->assertSame(':third_place:', $thirdPlace->getIcon());
        $this->assertSame('2/5', $thirdPlace->getPosition());

        /** @var Ranking $fourthPlace */
        $fourthPlace = $leaderboard->teams->shift();
        $this->assertEquals(':small_blue_diamond:', $fourthPlace->getIcon());
        $this->assertSame('2/5', $fourthPlace->getPosition());

    }

    protected function subjectUnderTesting(): GooseBoardService
    {
        return App::make(GooseBoardService::class);
    }
}
