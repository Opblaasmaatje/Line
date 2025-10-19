<?php

namespace App\Wise\SlashCommands\Competition;

use App\Laracord\Option;
use App\Laracord\SlashCommands\SlashCommandWithRuleValidation;
use App\Library\Services\CompetitionService;
use App\Models\Competition;
use App\Wise\SlashCommands\Parameters\HasMetric;
use Carbon\CarbonPeriod;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use React\Promise\PromiseInterface;

class CompetitionCreate extends SlashCommandWithRuleValidation
{
    use HasMetric;

    protected $name = 'competition-create';

    protected $description = 'Create a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setName('title')
                ->setDescription('Define the competition title')
                ->setType(Option::STRING)
                ->setRequired(true),

            $this->getMetricOption($this->discord()),

            Option::make($this->discord())
                ->setName('start date')
                ->setDescription('Define the starting date in dd-mm-yyyy format')
                ->setType(Option::STRING)
                ->setRequired(true),

            Option::make($this->discord())
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
            'start-date' => Rule::date(),
            'end-date' => Rule::date(),
        ];
    }

    protected function getValidationAttributes(): array
    {
        return [
            'title' => $this->value('title'),
            'start-date' => $this->value('start-date'),
            'end-date' => $this->value('end-date'),
        ];
    }

    protected function action(Ping|ApplicationCommand $interaction): PromiseInterface
    {
        $competition = $this->getCompetitionService()->create(
            title: $this->value('title'),
            metric: $this->metric,
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
            'metric' => $this->getMetricAutoCompleteCallback(),
        ];
    }

    protected function getCompetitionService(): CompetitionService
    {
        return App::make(CompetitionService::class);
    }
}
