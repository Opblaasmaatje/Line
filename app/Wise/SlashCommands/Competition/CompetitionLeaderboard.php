<?php

namespace App\Wise\SlashCommands\Competition;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Library\Services\CompetitionService;
use App\Wise\Client\Endpoints\Competition\DTO\ParticipantHistory;
use App\Wise\SlashCommands\Parameters\HasCompetition;
use App\Wise\SlashCommands\Parameters\HasMetric;
use Illuminate\Support\Facades\App;
use React\Promise\PromiseInterface;

class CompetitionLeaderboard extends BaseSlashCommand
{
    use HasMetric;
    use HasCompetition;

    protected $name = 'competition-leaderboard';

    protected $description = 'Get the leaderboard of a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function handle($interaction): PromiseInterface
    {
        $data = $this->getCompetitionService()->leaderboard(
            competition: $this->competition,
            metric: $this->metric
        );

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('The current rankings are!')
                ->fields(
                    $data->take(5)->flatMap(function (ParticipantHistory $participant) {
                        return [
                            $participant->player->username => $participant->collectHistory()->first()?->value,
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

    public function autocomplete(): array
    {
        return [
            'competition' => $this->getCompetitionAutocompleteCallback(),
            'metric' => $this->getMetricAutoCompleteCallback(),
        ];
    }

    protected function getCompetitionService(): CompetitionService
    {
        return App::make(CompetitionService::class);
    }
}
