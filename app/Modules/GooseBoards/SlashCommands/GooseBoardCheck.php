<?php

namespace App\Modules\GooseBoards\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;

class GooseBoardCheck extends BaseSlashCommand
{
    use HasGooseBoard;

    protected $name = 'goose-board-check';

    protected $description = 'Check the current goose board!';

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

    public function handle($interaction)
    {
        $path = storage_path('app/public/'.$this->gooseBoard->image);

        if (is_null($this->gooseBoard->image) || ! file_exists($path)) {
            return $interaction->respondWithMessage(
                $this
                    ->message('Goose board check!')
                    ->content('No board image found yet. Please generate a board first.')
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
