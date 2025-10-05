<?php

namespace App\Wise\SlashCommands;

use App\Laracord\SlashCommands\SlashCommandWithRuleValidation;
use App\Library\Services\CompetitionService;
use App\Models\Competition;
use App\Wise\Client\Enums\Metric;
use Carbon\CarbonPeriod;
use Discord\Parts\Interactions\Command\Option;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use React\Promise\PromiseInterface;

class StartCompetition extends SlashCommandWithRuleValidation
{
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

            (new Option($this->discord()))
                ->setName('metric')
                ->setDescription('Define the metric')
                ->setType(Option::STRING)
                ->setRequired(true),

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
            'metric' => $this->value('metric'),
            'start-date' => $this->value('start-date'),
            'end-date' => $this->value('end-date'),
        ];
    }

    protected function action($interaction): PromiseInterface
    {
        $competition = App::make(CompetitionService::class)->create(
            title: $this->value('title'),
            metric: Metric::from($this->value('metric')),
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
}
