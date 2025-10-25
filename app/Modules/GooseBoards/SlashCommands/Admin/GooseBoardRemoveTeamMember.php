<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Models\Account;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasTeam;
use App\SlashCommands\Parameters\HasAccount;

class GooseBoardRemoveTeamMember extends BaseSlashCommand
{
    use HasTeam;
    use HasAccount;

    protected $name = 'goose-board-remove-team-member';

    protected $description = 'Remove accounts from a team.';

    public function handle($interaction)
    {
        $this->teamService()->removeTeamMember(
            $this->account,
            $this->team
        );

        $message = $this
            ->message('See current lineup')
            ->title("Removed {$this->account->username} removed from {$this->team->name} :x:")
            ->info();

        $this->team->accounts()->take(25)->each(function (Account $account) use ($message) {
            return $message->field(":small_blue_diamond: $account->username", '', false);
        });

        return $message->reply($interaction);
    }

    public function options(): array
    {
        return [
            $this->getTeamOption($this->discord()),
            $this->getAccountOption($this->discord()),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'team' => $this->getTeamAutocompleteCallback(),
        ];
    }
}
