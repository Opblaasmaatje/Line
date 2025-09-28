<?php

namespace App\Wise\SlashCommands;

use App\Library\Services\CompetitionService;
use App\Wise\Client\Enums\Metric;
use Carbon\CarbonPeriod;
use Discord\Parts\Interactions\Command\Option;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laracord\Commands\SlashCommand;

class StartCompetition extends SlashCommand
{
    protected $name = 'start-competition';

    protected $description = 'Starts a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            (new option($this->discord()))
                ->setName('title')
                ->setDescription('Define the competition title')
                ->setType(Option::STRING)
                ->setRequired(true),

            (new option($this->discord()))
                ->setName('metric')
                ->setDescription('Define the metric')
                ->setType(Option::STRING)
                ->setRequired(true),

            (new option($this->discord()))
                ->setName('start date')
                ->setDescription('Define the starting date in dd-mm-yyyy format')
                ->setType(Option::STRING)
                ->setRequired(true),

            (new option($this->discord()))
                ->setName('end date')
                ->setDescription('Define the ending date in dd-mm-yyyy format')
                ->setType(Option::STRING)
                ->setRequired(true),
        ];
    }

    protected function getRules(): array
    {
        return [
            'metric' => Rule::enum(Metric::class),
            'start-date' => Rule::date(),
            'end-date' => Rule::date(),
        ];
    }

    public function handle($interaction)
    {
        if (! $this->isValid($this->value())) {
            return $interaction->respondWithMessage(
                $this->message()
                    ->error()
                    ->title('Invalid payload!')
                    ->content('Please check your competition details')
                    ->build()
            );
        }

        $competition = App::make(CompetitionService::class)->create(
            competition: $this->value('title'),
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
                ->title("Created competition!")
                ->content("View! {$competition->url}")
                ->build()
        );
    }

    private function isValid()
    {
        $validator = Validator::make([
            'metric' => $this->value('metric'),
            'start-date' => $this->value('start-date'),
            'end-date' => $this->value('end-date'),
        ], $this->getRules());

        return $validator->passes();
    }
}
