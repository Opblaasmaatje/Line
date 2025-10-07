<?php

namespace App\Wise\SlashCommands\Competition;

use App\Laracord\Option;
use App\Laracord\SlashCommands\SlashCommandWithRuleValidation;
use App\Library\Services\CompetitionService;
use App\Models\Competition;
use App\Wise\Client\Enums\Metric;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Laracord\Commands\SlashCommand;
use React\Promise\PromiseInterface;

class LeaderboardCompetition extends SlashCommandWithRuleValidation
{
    protected $name = 'leaderboard-competition';

    protected $description = 'Get the leaderboard of a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setName('competition')
                ->setType(Option::STRING)
                ->setAutoComplete(true)
                ->setDescription('Define the competition to delete')
                ->setRequired(true),

            Option::make($this->discord())
                ->setName('metric')
                ->setType(Option::STRING)
                ->setAutoComplete(true)
                ->setDescription('Define the competition to delete')
                ->setRequired(true),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'competition' => fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
                ? Competition::query()->where('title', 'like', "%{$value}%")->take(25)->pluck('title')->toArray()
                : Competition::query()->take(25)->pluck('title')->toArray(),

            'metric' => fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
                ? Metric::search($value)
                    ->map(fn (Metric $metric) => $metric->toHeadline())
                    ->take(25)
                    ->values()
                    ->toArray()

                : collect(Metric::cases())
                    ->map(fn (Metric $metric) => $metric->toHeadline())
                    ->toArray(),
        ];
    }

    protected function action(Ping|ApplicationCommand $interaction): PromiseInterface
    {
        $competition = Competition::query()
            ->where('title', $this->value('competition'))
            ->firstOrFail();

        $data = $this->service()->leaderboard(
            $competition,
            Metric::from($this->value('metric'))
        );

        dd($data);

        return $interaction;
    }

    protected function getValidationRules(): array
    {
        return [
            'title' => Rule::exists(Competition::class, 'title'),
            'metric' => Rule::enum(Metric::class),
        ];
    }

    protected function getValidationAttributes(): array
    {
        return [
            'title' => $this->value('competition'),
            'metric' => $this->value('metric'),
        ];
    }

    protected function service(): CompetitionService
    {
        return App::make(CompetitionService::class);
    }
}
