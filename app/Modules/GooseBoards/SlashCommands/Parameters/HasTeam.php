<?php

namespace App\Modules\GooseBoards\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Laracord\SlashCommands\ValidatableCallback;
use App\Modules\GooseBoards\Library\Services\GooseBoardService;
use App\Modules\GooseBoards\Library\Services\TeamService;
use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Team;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Illuminate\Support\Facades\App;

trait HasTeam
{
    protected Team $team;

    public function bootHasTeam(): void
    {
        $validatableCallback = new ValidatableCallback(function ($interaction) {
            if (! $this->value('team')) {
                $interaction->respondWithMessage(
                    $this
                        ->message('team not given as parameter!')
                        ->error()
                        ->content('team not given as parameter!')
                        ->build()
                );

                return false;
            }

            $team = $this->getTeamService()->repository->find(
                $this->value('team')
            );

            if (is_null($team)) {
                $interaction->respondWithMessage(
                    $this
                        ->message('team is not valid!')
                        ->warning()
                        ->content('team is not valid!')
                        ->build()
                );

                return false;
            }

            $this->team = $team;

            return true;
        });

        $this->addBeforeCallback($validatableCallback);
    }

    public function getTeamOption(DiscordCommandClient $client)
    {
        return Option::make($client)
            ->setName('team')
            ->setRequired(true)
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the team');

    }

    public function getTeamAutocompleteCallback(): Closure
    {
        return fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
            ? $this->getTeamService()
                ->repository
                ->searchByName($value)
                ->take(25)
                ->pluck('name')
                ->toArray()
            : $this
                ->getTeamService()
                ->repository
                ->get()
                ->take(25)
                ->pluck('name')
                ->toArray();
    }

    protected function getTeamService(): TeamService
    {
        return App::make(TeamService::class);
    }
}
