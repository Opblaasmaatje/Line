<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Modules\GooseBoards\Library\Services\TileService;
use App\Modules\GooseBoards\Models\Tile;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasTile;
use Illuminate\Support\Facades\App;

class GooseBoardRemoveTile extends BaseSlashCommand
{
    use AdminCommand;
    use HasTile;

    protected $name = 'goose-board-remove-tile';

    protected $description = 'Remove a tile from a goose board.';

    public function handle($interaction)
    {
        $gooseBoard = $this->tile->gooseBoard;

        $this->tileService()->remove($this->tile);

        $message = $this
            ->message('Removed the tile')
            ->title("Tile removed from {$gooseBoard->name}}")
            ->success();

        $gooseBoard->tiles()->each(function (Tile $tile) use ($message) {
            $message->field("{$tile->name} at position: {$tile->position}", '', false);
        });

        return $interaction->respondWithMessage(
            $message->build()
        );
    }

    public function options(): array
    {
        return [
            $this->getTileOption($this->discord()),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'tile' => $this->getTileAutocomplete(),
        ];
    }

    protected function tileService(): TileService
    {
        return App::make(TileService::class);
    }
}
