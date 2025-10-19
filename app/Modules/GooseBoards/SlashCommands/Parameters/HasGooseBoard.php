<?php

namespace App\Modules\GooseBoards\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Laracord\SlashCommands\ValidatableCallback;
use App\Modules\GooseBoards\Library\Service\GooseBoardService;
use App\Modules\GooseBoards\Models\GooseBoard;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Illuminate\Support\Facades\App;

trait HasGooseBoard
{
    protected GooseBoard $gooseBoard;

    public function bootHasGooseBoard(): void
    {
        $validatableCallback = new ValidatableCallback(function ($interaction) {
            if (! $this->value('goose-board')) {
                $interaction->respondWithMessage(
                    $this
                        ->message('goose-board not given as parameter!')
                        ->error()
                        ->content('goose-board not given as parameter!')
                        ->build()
                );

                return false;
            }

            $gooseBoard = $this->getGooseBoardService()->repository->find(
                $this->value('goose-board')
            );

            if (is_null($gooseBoard)) {
                $interaction->respondWithMessage(
                    $this
                        ->message('Goose-board is not valid!')
                        ->warning()
                        ->content('Goose-board is not valid!')
                        ->build()
                );

                return false;
            }

            $this->gooseBoard = $gooseBoard;

            return true;
        });

        $this->addBeforeCallback($validatableCallback);
    }

    public function getGooseBoardOption(DiscordCommandClient $client)
    {
        return Option::make($client)
            ->setName('goose-board')
            ->setRequired(true)
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the goose board');

    }

    public function getGooseBoardAutocompleteCallback(): Closure
    {
        return fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
            ? $this->getGooseBoardService()
                ->repository
                ->searchByName($value)
                ->take(25)
                ->pluck('name')
                ->toArray()
            : $this
                ->getGooseBoardService()
                ->repository
                ->get()
                ->take(25)
                ->pluck('name')
                ->toArray();
    }

    protected function getGooseBoardService()
    {
        return App::make(GooseBoardService::class);
    }
}
