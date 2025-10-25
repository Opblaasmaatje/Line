<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Modules\GooseBoards\Models\Team;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasTeam;
use React\Promise\PromiseInterface;

class GooseBoardRemoveTeam extends BaseSlashCommand
{
    use AdminCommand;
    use HasTeam;

    protected $name = 'goose-board-remove-team';

    protected $description = 'Create a goose board team.';

    public function handle($interaction): PromiseInterface
    {
        $gooseBoard = $this->team->gooseBoard;

        $this->teamService()->remove($this->team);

        $message = $this
            ->message('Current team configuration!')
            ->title('Successfully removed team.')
            ->success();

        $gooseBoard->teams()->each(function (Team $team) use ($message) {
            return $message->field(":small_blue_diamond: {$team->name}", '', false);
        });

        return $message->reply($interaction);
    }

    public function options(): array
    {
        return [
            $this->getTeamOption($this->discord()),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'team' => $this->getTeamAutocompleteCallback(),
        ];
    }
}
