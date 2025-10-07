<?php

namespace App\Wise\SlashCommands\Competition;

use App\Laracord\SlashCommands\SlashCommandWithRuleValidation;
use App\Library\Services\CompetitionService;
use App\Models\Competition;
use App\Wise\Client\Enums\Metric;
use App\Wise\SlashCommands\Concerns\HasCompetition;
use App\Wise\SlashCommands\Concerns\HasMetric;
use Carbon\CarbonPeriod;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Command\Option;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use React\Promise\PromiseInterface;

class StartCompetition extends SlashCommandWithRuleValidation
{
    use HasCompetition;
    use HasMetric;

    protected $name = 'start-competition';

    protected $description = 'Starts a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            (new Option($this->discord()))
                ->setName('title')
                ->setDescription('Define the competition title')
                ->setType(Option::STRING)
                ->setRequired(true),

            $this->getMetricOption($this->discord()),

            (new Option($this->discord()))
                ->setName('start date')
                ->setDescription('Define the starting date in dd-mm-yyyy format')
                ->setType(Option::STRING)
                ->setRequired(true),

            (new Option($this->discord()))
                ->setName('end date')
                ->setDescription('Define the ending date in dd-mm-yyyy format')
                ->setType(Option::STRING)
                ->setRequired(true),
        ];
    }

    protected function getValidationRules(): array
    {
        return [
            'title' => Rule::unique(Competition::class, 'title'),
            'metric' => Rule::enum(Metric::class),
            'start-date' => Rule::date(),
            'end-date' => Rule::date(),
        ];
    }

    protected function getValidationAttributes(): array
    {
        return [
            'title' => $this->value('title'),
            'metric' => Str::snake(
                $this->value('metric')
            ),
            'start-date' => $this->value('start-date'),
            'end-date' => $this->value('end-date'),
        ];
    }

    protected function action(Ping|ApplicationCommand $interaction): PromiseInterface
    {
        $competition = $this->service()->create(
            title: $this->value('title'),
            metric: Metric::fromHeadline($this->value('metric')),
            period: CarbonPeriod::create(
                $this->value('start-date'),
                $this->value('end-date')
            )
        );

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Created competition!')
                ->content("View! {$competition->url}")
                ->build()
        );
    }

    public function autocomplete(): array
    {
        return [
            'metric' => $this->getMetricAutocomplete(),
        ];
    }

    protected function service(): CompetitionService
    {
        return App::make(CompetitionService::class);
    }
}
