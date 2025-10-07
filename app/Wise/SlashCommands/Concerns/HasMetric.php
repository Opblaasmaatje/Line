<?php

namespace App\Wise\SlashCommands\Concerns;

use App\Laracord\Option;
use App\Wise\Client\Enums\Metric;
use Closure;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;

trait HasMetric
{
    protected function getMetricOption(DiscordCommandClient $client)
    {
        return Option::make($client)
            ->setName('metric')
            ->setType(Option::STRING)
            ->setAutoComplete(true)
            ->setDescription('Define the competition to delete')
            ->setRequired(true);
    }

    protected function getMetricAutocomplete(): Closure
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
