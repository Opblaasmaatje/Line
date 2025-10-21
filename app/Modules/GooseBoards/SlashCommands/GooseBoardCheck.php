<?php

namespace App\Modules\GooseBoards\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;

class GooseBoardCheck extends BaseSlashCommand
{
    use HasGooseBoard;

    protected $name = 'goose-board-check';

    protected $description = 'Check the current goose board.';

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

    protected function getBoard(): string
    {
        if (! $this->gooseBoard->image || ! file_exists(storage_path('app/public/'.$this->gooseBoard->image))) {
            $this->getGooseBoardService()->generateBoard($this->gooseBoard);
        }

        return storage_path('app/public/'.$this->gooseBoard->image);
    }

    public function handle($interaction)
    {
        $path = $this->getBoard();

        if (! file_exists($path)) {
            return $interaction->respondWithMessage(
                $this
                    ->message('Could not get goose board!')
                    ->content(':fire: Please contact the developer. :fire:')
                    ->warning()
                    ->build()
            );
        }

        return $interaction->respondWithMessage(
            $this
                ->message('Goose board check!')
                ->content('This is the current goose board!')
                ->filePath($path, $this->gooseBoard->image)
                ->image($this->gooseBoard->image)
                ->info()
                ->build()
        );
    }
}
