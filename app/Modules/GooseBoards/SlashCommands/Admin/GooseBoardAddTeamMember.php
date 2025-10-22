<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Models\Account;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasTeam;
use App\SlashCommands\Parameters\HasAccount;

class GooseBoardAddTeamMember extends BaseSlashCommand
{
    use HasTeam;
    use HasAccount;

    protected $name = 'goose-board-add-team-member';

    protected $description = 'Add accounts to a team.';

    public function handle($interaction): void
    {
        $this->getTeamService()->addTeamMember(
            $this->account,
            $this->team
        );


        $message = $this
            ->message("See current lineup")
            ->title("Added {$this->account->username} to team {$this->team->name} :white_check_mark:")
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
