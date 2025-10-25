<?php

namespace App\Modules\GooseBoards\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Laracord\SlashCommands\ValidatableCallback;
use App\Modules\GooseBoards\Library\Services\TeamService;
use App\Modules\GooseBoards\Library\Services\TileService;
use App\Modules\GooseBoards\Models\Team;
use App\Modules\GooseBoards\Models\Tile;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Illuminate\Support\Facades\App;

trait HasTile
{
    protected Tile $tile;

    public function bootHasTile(): void
    {
        $validatableCallback = new ValidatableCallback(function ($interaction) {
            if (! $this->value('tile')) {
                $interaction->respondWithMessage(
                    $this
                        ->message('tile not given as parameter!')
                        ->error()
                        ->content('tile not given as parameter!')
                        ->build()
                );

                return false;
            }

            $tile = $this->tileService()->repository->find($this->value('tile'));

            if (is_null($tile)) {
                $interaction->respondWithMessage(
                    $this
                        ->message('tile is not valid!')
                        ->warning()
                        ->content('tile is not valid!')
                        ->build()
                );

                return false;
            }

            $this->tile = $tile;

            return true;
        });

        $this->addBeforeCallback($validatableCallback);
    }

    public function getTileOption(DiscordCommandClient $client)
    {
        return Option::make($client)
            ->setName('tile')
            ->setRequired(true)
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the tile');

    }

    public function getTileAutocomplete(): Closure
    {
        return fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
            ? $this->tileService()
                ->repository
                ->search($value)
                ->take(25)
                ->pluck('name')
                ->toArray()

            : $this
                ->tileService()
                ->repository
                ->query
                ->get()
                ->take(25)
                ->pluck('name')
                ->toArray();
    }

    protected function tileService(): TileService
    {
        return App::make(TileService::class);
    }
}
