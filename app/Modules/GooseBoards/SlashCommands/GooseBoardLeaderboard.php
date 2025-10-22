<?php

namespace App\Modules\GooseBoards\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\GooseBoards\Library\Services\Leaderboard\Ranking;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;

class GooseBoardLeaderboard extends BaseSlashCommand
{
    use HasGooseBoard;

    protected $name = 'goose-board-leaderboard';

    protected $description = 'Get the leaderboard for a goose board.';

    public function options(): array
    {
        return [
            $this->getGooseBoardOption($this->discord()),
        ];
    }

    public function handle($interaction)
    {
        $leaderboard = $this->getGooseBoardService()->leaderboard($this->gooseBoard);

        $message = $this->message()->info()->title(":trophy: Leaderboard for {$this->gooseBoard->name}!");

        $leaderboard->teams->each(function (Ranking $ranking) use ($message) {
            $message->field("{$ranking->getIcon()}: {$ranking->team->name} ({$ranking->getPosition()})", ' ', false);
        });

        $message->footerText("Total teams participating: {$leaderboard->teams->count()}");

        return $interaction->respondWithMessage(
            $message->build()
        );
    }

    public function autocomplete(): array
    {
        return [
            'goose-board' => $this->getGooseBoardAutocompleteCallback(),
        ];
    }
}
