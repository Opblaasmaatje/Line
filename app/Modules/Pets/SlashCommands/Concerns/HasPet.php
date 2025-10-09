<?php

namespace App\Modules\Pets\SlashCommands\Concerns;

use App\Laracord\Option;
use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\Models\Enums\PetName;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Illuminate\Support\Facades\App;

trait HasPet
{
    protected function getPetOption(DiscordCommandClient $client): Option
    {
        return Option::make($client)
            ->setName('pet')
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the pet.')
            ->setRequired(true);
    }

    protected function getPetAutocompletion(): Closure
    {
        return fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
            ? PetName::search($value)
                ->map(fn (PetName $pet) => $pet->toHeadline())
                ->take(25)
                ->values()
                ->toArray()

            : collect(PetName::cases())
                ->map(fn (PetName $pet) => $pet->toHeadline())
                ->toArray();
    }

    protected function getPetService(): PetService
    {
        return App::make(PetService::class);
    }
}
