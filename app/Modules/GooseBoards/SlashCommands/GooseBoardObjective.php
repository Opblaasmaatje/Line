<?php

namespace App\Modules\GooseBoards\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\GooseBoards\Library\Service\TeamService;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;
use App\Wise\SlashCommands\Parameters\HasAccount;
use Illuminate\Support\Facades\App;

class GooseBoardObjective extends BaseSlashCommand
{
    use HasGooseBoard;
    use HasAccount;

    protected $name = 'goose-board-objective';

    protected $description = 'Get the objective of a team for the goose board';

    public function options(): array
    {
        return [
            $this->getGooseBoardOption($this->discord()),
            $this->getAccountOption($this->discord()),
        ];
    }

    public function handle($interaction)
    {
        $team = $this->getTeamService()->repository->findTeam(
            $this->account,
            $this->gooseBoard,
        );

        if (is_null($team)) {
            return $interaction->respondWithMessage(
                $this
                    ->message('This user does not have a team for this goose board!')
                    ->warning()
                    ->build()
            );
        }

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->info()
                ->title("The current objective of team [{$team->name}] is to get [{$team->objective->name}], go get it! 🔥")
                ->content("The current tile for [{$team->name}] is $team->position/{$this->gooseBoard->tiles->count()}")
                ->imageUrl($team->objective->image_url)
                ->build(), true
        );
    }

    protected function getTeamService(): TeamService
    {
        return App::make(TeamService::class);
    }

    public function autocomplete(): array
    {
        return [
            'goose-board' => $this->getGooseBoardAutocompleteCallback(),
        ];
    }
}
