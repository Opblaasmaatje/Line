<?php

namespace App\Wise\SlashCommands\Competition;

use App\Laracord\SlashCommands\SlashCommandWithRuleValidation;
use App\Library\Services\CompetitionService;
use App\Models\Competition;
use App\Wise\Client\Endpoints\Competition\DTO\ParticipantHistory;
use App\Wise\Client\Enums\Metric;
use App\Wise\SlashCommands\Concerns\HasCompetition;
use App\Wise\SlashCommands\Concerns\HasMetric;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use React\Promise\PromiseInterface;

class LeaderboardCompetition extends SlashCommandWithRuleValidation
{
    use HasMetric;
    use HasCompetition;

    protected $name = 'leaderboard-competition';

    protected $description = 'Get the leaderboard of a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    protected function action(Ping|ApplicationCommand $interaction): PromiseInterface
    {
        $data = $this->service()->leaderboard(
            competition: $this->getCompetitionRepository()->byTitle($this->value('competition')),
            metric: Metric::fromHeadline($this->value('metric'))
        );

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('The current rankings are!')
                ->fields(
                    $data->take(5)->flatMap(function (ParticipantHistory $participant) {
                        return [
                            $participant->player->username => $participant->collectHistory()->first()?->value ?? 0,
                        ];
                    }),
                    inline: false,
                )
                ->build(),
        );
    }

    public function options(): array
    {
        return [
            $this->getCompetitionOption($this->discord()),
            $this->getMetricOption($this->discord()),
        ];
    }

    protected function getValidationRules(): array
    {
        return [
            'competition' => Rule::exists(Competition::class, 'title'),
            'metric' => Rule::enum(Metric::class),
        ];
    }

    protected function getValidationAttributes(): array
    {
        return [
            'competition' => $this->value('competition'),
            'metric' => Str::snake(
                $this->value('metric')
            ),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'competition' => $this->getCompetitionAutocomplete(),
            'metric' => $this->getMetricAutocomplete(),
        ];
    }

    protected function service(): CompetitionService
    {
        return App::make(CompetitionService::class);
    }
}
