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
        $this->assertEquals(1, $tile->position);
        $this->assertEquals('john test tile', $tile->name);
        $this->assertEquals('john-test-tile.png', $tile->image_url);

        $tile = $this->subjectUnderTesting()->insert($gooseBoard, 'new test tile', 'new-test-tile.png', 2);
        $this->assertModelExists($tile);
        $this->assertEquals(2, $tile->position);
        $this->assertEquals('new test tile', $tile->name);
        $this->assertEquals('new-test-tile.png', $tile->image_url);

        $tile = $this->subjectUnderTesting()->insert($gooseBoard, 'inserted tile', 'inserted-tile.png', 1);
        $this->assertModelExists($tile);
        $this->assertEquals(1, $tile->position);
        $this->assertEquals('inserted tile', $tile->name);
        $this->assertEquals('inserted-tile.png', $tile->image_url);

        $this->assertEquals([
            'inserted tile' => 1,
            'john test tile' => 2,
            'new test tile' => 3,
        ], $tile->gooseBoard->tiles()->pluck('position', 'name')->toArray()
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
