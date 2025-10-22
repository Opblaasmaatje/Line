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

    public function handle($interaction): void
    {
        $this->getTeamService()->removeTeamMember(
            $this->account,
            $this->team
        );

        $message = $this
            ->message("See current lineup")
            ->title("Removed {$this->account->username} removed from {$this->team->name} :x:")
            ->success();

        $this->team->accounts->take(25)->each(function (Account $account) use ($message) {
            return $message->field(":small_blue_diamond: $account->username", '', false);
        });

        $interaction->respondWithMessage(
            $message->build(),
        );
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
            'team' => $this->getTeamAutocompleteCallback()
        ];
    }
}
