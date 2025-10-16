<?php

namespace App\Wise\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Library\Repository\CompetitionRepository;
use App\Models\Competition;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Discord\Parts\Interactions\Interaction;
use Illuminate\Support\Facades\App;

trait HasCompetition
{
    protected Competition $competition;

    protected function getCompetitionOption(DiscordCommandClient $client): Option
    {
        return Option::make($client)
            ->setName('competition')
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the competition to delete')
            ->setRequired(true);
    }

    protected function getCompetitionAutocompleteCallback(): Closure
    {
        return fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
            ? $this->getCompetitionRepository()
                ->likeTitle($value)
                ->pluck('title')
                ->toArray()

            : $this
                ->getCompetitionRepository()
                ->get()
                ->take(25)
                ->pluck('title')
                ->toArray();
    }

    protected function getCompetitionRepository(): CompetitionRepository
    {
        return App::make(CompetitionRepository::class);
    }

    protected function bootHasCompetition(): void
    {
        $this->addBeforeCallback(function (Interaction $interaction) {
            if (! $this->value('competition')) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('Competition not given as parameter!')
                        ->error()
                        ->content('Competition not given as parameter!')
                        ->build()
                );
            }

            $competition = $this->getCompetitionRepository()->byTitle(
                $this->value('competition')
            );

            if (! $competition) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('Competition does not exist!')
                        ->warning()
                        ->content('Please enter a valid competition!')
                        ->build()
                );
            }

            $this->competition = $competition;
        });
    }
}
