<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\GooseBoardService;

use App\Modules\GooseBoards\Library\Service\GooseBoardService;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TileFactory;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class GenerateBoardTest extends ApplicationCase
{
    #[Test]
    public function it_generates_a_board()
    {
        Storage::fake('public');

        $gooseBoard = GooseBoardFactory::new()
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->create();

        $this->subjectUnderTesting()->generateBoard($gooseBoard);

        $this->assertStringContainsString('board', $gooseBoard->image);
    }

    protected function subjectUnderTesting(): GooseBoardService
    {
        return $this->app->make(GooseBoardService::class);
    }
}
