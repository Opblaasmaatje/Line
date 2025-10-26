<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\Option;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Modules\GooseBoards\Library\Services\TeamService;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;
use Illuminate\Support\Facades\App;
use React\Promise\PromiseInterface;

class GooseBoardCreateTeam extends BaseSlashCommand
{
    use AdminCommand;
    use HasGooseBoard;

    protected $name = 'gb-create-team';

    protected $description = 'Create a goose board team.';

    public function handle($interaction): PromiseInterface
    {
        $team = $this->teamService()->create(
            board: $this->gooseBoard,
            teamName: $this->value('name'),
            channelId: $this->value('channel-id'),
        );

        return $this
            ->message("Successfully created team {$team->name}")
            ->success()
            ->reply($interaction);
    }

    protected function teamService(): TeamService
    {
        return App::make(TeamService::class);
    }

    public function options(): array
    {
        return [
            $this->getGooseBoardOption($this->discord()),

            Option::make($this->discord())
                ->setName('name')
                ->setDescription('Define the name of the team')
                ->setType(Option::STRING)
                ->setRequired(true),

            Option::make($this->discord())
                ->setName('channel-id')
                ->setDescription('Discord channel ID where the team operates')
                ->setType(Option::STRING)
                ->setRequired(true),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'goose-board' => $this->getGooseBoardAutocompleteCallback(),
        ];
    }
}
