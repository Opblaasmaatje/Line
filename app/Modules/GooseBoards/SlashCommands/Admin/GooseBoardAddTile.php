<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\Option;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Modules\GooseBoards\Library\Services\TileService;
use App\Modules\GooseBoards\Models\Tile;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;
use App\SlashCommands\Parameters\HasImage;
use Illuminate\Support\Facades\App;

class GooseBoardAddTile extends BaseSlashCommand
{
    use AdminCommand;
    use HasImage;
    use HasGooseBoard;

    protected $name = 'goose-board-add-tile';

    protected $description = 'Add tile';

    public function handle($interaction)
    {
        $newTile = $this->tileService()->insert(
            $this->gooseBoard,
            $this->value('objective'),
            $this->getImage($interaction)->url,
            $this->value('index')
        );

        $message = $this
            ->message('Add a new tile')
            ->success();

        $this->gooseBoard->tiles->each(function (Tile $tile) use ($message, $newTile) {
            if($tile->is($newTile)){
                return $message->field("{$tile->name} at position: {$tile->index} :point_left:", '', false);
            }

            return $message->field("{$tile->name} at position: {$tile->index}", '', false);
        });

        return $interaction->respondWithMessage(
            $message->build()
        );
    }

    public function options(): array
    {
        return [
            $this->getImageOption($this->discord()),
            $this->getGooseBoardOption($this->discord()),

            Option::make($this->discord())
                ->setName('objective')
                ->setType(Option::STRING)
                ->setDescription('The objective description')
                ->setRequired(true),

            Option::make($this->discord())
                ->setName('index')
                ->setType(Option::INTEGER)
                ->setDescription('The index of the tile, when the index already exists the tile will be inserted in the given spot')
                ->setRequired(true),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'goose-board' => $this->getGooseBoardAutocompleteCallback(),
        ];
    }

    protected function tileService(): TileService
    {
        return App::make(TileService::class);
    }
}
