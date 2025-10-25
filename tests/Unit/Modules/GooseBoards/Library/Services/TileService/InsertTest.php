<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\TileService;

use App\Modules\GooseBoards\Library\Services\TileService;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TileFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class InsertTest extends ApplicationCase
{
    #[Test]
    public function it_inserts()
    {
        $gooseBoard = GooseBoardFactory::new()->create();

        $tile = $this->subjectUnderTesting()->insert($gooseBoard, 'john test tile', 'john-test-tile.png', 1);

        $this->assertModelExists($tile);

        $this->assertTrue(
            $tile->is($gooseBoard->tiles()->sole())
        );
    }

    #[Test]
    public function it_inserts_and_changes_all_tiles_around_when_duplicate_entry_is_added()
    {
        $gooseBoard = GooseBoardFactory::new()
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->create();

        $this->assertEquals([1, 2, 3], $gooseBoard->tiles()->pluck('position')->toarray());

        $tile = $this->subjectUnderTesting()->insert($gooseBoard, 'inserted tile', 'inserted-tile.png', 2);

        $this->assertEquals(2, $tile->position);
        $this->assertEquals([1, 2, 3, 4], $gooseBoard->tiles()->pluck('position')->toarray());
    }

    protected function subjectUnderTesting(): TileService
    {
        return $this->app->make(TileService::class);
    }
}
