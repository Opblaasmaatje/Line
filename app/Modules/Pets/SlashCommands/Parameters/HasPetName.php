<?php

namespace App\Modules\Pets\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Modules\Pets\Models\Enums\PetName;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Discord\Parts\Interactions\Interaction;

trait HasPetName
{
    protected PetName $petName;

    protected function getPetNameOption(DiscordCommandClient $client): Option
    {
        return Option::make($client)
            ->setName('pet-name')
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the pet.')
            ->setRequired(true);
    }

    protected function bootHasPetName(): void
    {
        $this->addBeforeCallback(function (Interaction $interaction) {
            if (! $this->value('pet-name')) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('pet-name not given as parameter!')
                        ->error()
                        ->content('pet-name not given as parameter!')
                        ->build()
                );
            }

            $petName = PetName::tryFrom($this->value('pet-name'));

            if (is_null($petName)) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('Pet name is not valid!')
                        ->warning()
                        ->content('Pet name is not valid!')
                        ->build()
                );
            }

            $this->petName = $petName;
        });
    }

    protected function getPetNameAutocompleteCallback(): Closure
    {
        return fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
            ? PetName::search($value)
                ->map(fn (PetName $pet) => $pet->value)
                ->take(25)
                ->values()
                ->toArray()

            : collect(PetName::cases())
                ->map(fn (PetName $pet) => $pet->value)
                ->toArray();
    }
}
