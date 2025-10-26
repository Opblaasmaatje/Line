<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\Option;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Modules\GooseBoards\Library\Services\GooseBoardService;
use App\Modules\GooseBoards\Library\Services\Leaderboard\Ranking;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasTeam;
use Illuminate\Support\Facades\App;

class GooseBoardSetTeamPosition extends BaseSlashCommand
{
    use AdminCommand;
    use HasTeam;

    protected $name = 'gb-set-team-position';

    protected $description = 'Set the position of a team';

    public function handle($interaction)
    {
        $team = $this->teamService()->setPosition(
            $this->team,
            $this->value('position'),
        );

        $leaderboard = $this->gooseBoardService()->leaderboard($team->gooseBoard);

        $message = $this
            ->message("Updated {$team->name}'s position to {$team->position}, the verification code remains the same {$team->verification_code}")
            ->title('Successfully updated team position')
            ->success();

        $leaderboard->teams->take(25)->each(
            fn (Ranking $ranking) => $message->field("{$ranking->getIcon()} {$ranking->team->name} {$ranking->getPosition()}", '', false)
        );

        return $message->reply($interaction);
    }

    public function options(): array
    {
        return [
            $this->getTeamOption($this->discord()),

            Option::make($this->discord())
                ->setType(Option::INTEGER)
                ->setDescription('Set team position')
                ->setRequired(true)
                ->setName('position'),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'team' => $this->getTeamAutocompleteCallback(),
        ];
    }

    protected function gooseBoardService(): GooseBoardService
    {
        return App::make(GooseBoardService::class);
    }
}
