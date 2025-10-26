<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\TileService;

use App\Modules\GooseBoards\Library\Services\TileService;
use App\Modules\GooseBoards\Models\Tile;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TileFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class RemoveTest extends ApplicationCase
{
    public static function positions(): array
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5],
        ];
    }

    #[Test]
    #[DataProvider('positions')]
    public function it_can_be_removed_and_sorting_is_still_normal(int $position)
    {
        $position--;

         $gooseBoard = GooseBoardFactory::new()
             ->has(TileFactory::new())
             ->has(TileFactory::new())
             ->has(TileFactory::new())
             ->has(TileFactory::new())
             ->has(TileFactory::new())
             ->create();

         /** @var Tile $tile */
         $tile = $gooseBoard->tiles->get($position);

         $this->subjectUnderTesting()->remove($tile);

         $gooseBoard->load('tiles');

         $this->assertEquals([1, 2, 3, 4], $gooseBoard->tiles->pluck('position')->toArray());
    }

    protected function subjectUnderTesting(): TileService
    {
        return $this->app->make(TileService::class);
    }
}
