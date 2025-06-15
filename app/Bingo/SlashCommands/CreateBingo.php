<?php

namespace App\Bingo\SlashCommands;

use App\Bingo\BingoHandler;
use Discord\Parts\Interactions\Command\Option;
use Laracord\Commands\SlashCommand;

class CreateBingo extends SlashCommand
{
    protected $name = 'create-bingo';

    protected $description = 'Creates a Bingo';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            (new option($this->discord()))
                ->setName('Bingo name')
                ->setDescription('Set bingo name')
                ->setType(Option::STRING)
                ->setRequired(true),
        ];
    }

    public function handle($interaction): void
    {
        (new BingoHandler($this->value('bingo-name')));

        $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Bingo has been created!')
                ->content("The name is [{$this->value('bingo-name')}]")
                ->build()
        );
    }
}
