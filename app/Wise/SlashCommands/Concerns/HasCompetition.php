<?php

namespace App\Wise\SlashCommands\Concerns;

use App\Laracord\Option;
use App\Library\Repository\CompetitionRepository;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Illuminate\Support\Facades\App;

trait HasCompetition
{
    protected function getCompetitionOption(DiscordCommandClient $client): Option
    {
        return Option::make($client)
            ->setName('competition')
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the competition to delete')
            ->setRequired(true);
    }

    protected function getCompetitionAutocomplete(): Closure
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
}
