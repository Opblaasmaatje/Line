<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;

class GooseBoardRefreshBoard extends BaseSlashCommand
{
    use AdminCommand;
    use HasGooseBoard;

    protected $name = 'gb-refresh-board';

    protected $description = 'refresh the goose board.';

    public function handle($interaction): void
    {
        $this->gooseBoardService()->generateBoard($this->gooseBoard);

        $this
            ->message('Use /goose-board-check to view the board!')
            ->title('successfully regenerated the board!')
            ->success()
            ->reply($interaction);
    }

    public function options(): array
    {
        return [
            $this->getGooseBoardOption($this->discord()),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'goose-board' => $this->getGooseBoardAutocompleteCallback(),
        ];
    }
}
