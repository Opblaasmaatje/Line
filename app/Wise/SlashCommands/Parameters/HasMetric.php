<?php

namespace App\Wise\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Wise\Client\Enums\Metric;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Discord\Parts\Interactions\Interaction;

trait HasMetric
{
    protected Metric $metric;

    protected function getMetricOption(DiscordCommandClient $client): Option
    {
        return Option::make($client)
            ->setName('metric')
            ->setDescription('What metric do you want to know?')
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setRequired(true);
    }

    protected function bootHasMetric(): void
    {
        $this->addBeforeCallback(function (Interaction $interaction) {
            if (! $this->value('metric')) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('Metric not given as parameter!')
                        ->error()
                        ->content('Metric not given as parameter!')
                        ->build()
                );
            }

            $metric = Metric::tryFromHeadline($this->value('metric'));

            if (! $metric) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('Invalid metric given!')
                        ->warning()
                        ->content('Please give a valid metric!')
                        ->build()
                );
            }

            $this->metric = $metric;
        });
    }

    protected function getMetricAutoCompleteCallback(): Closure
    {
        return fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
            ? Metric::search($value)
                ->map(fn (Metric $metric) => $metric->toHeadline())
                ->take(25)
                ->values()
                ->toArray()

            : collect(Metric::cases())
                ->map(fn (Metric $metric) => $metric->toHeadline())
                ->toArray();
    }
}
