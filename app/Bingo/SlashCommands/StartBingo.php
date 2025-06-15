<?php

namespace App\Bingo\SlashCommands;

use App\Bingo\BingoHandler;
use App\Bingo\Models\Bingo;
use Discord\Parts\Interactions\Command\Option;
use Laracord\Commands\SlashCommand;

class StartBingo extends SlashCommand
{
    protected $name = 'start-bingo';

    protected $description = 'Starts a bingo';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        $bingoSelect = $this->createBingoSelect();

        return [
            $bingoSelect,
        ];
    }

    public function handle($interaction): void
    {
        $bingo = Bingo::query()->findOrFail($this->value('bingo'));

        (new BingoHandler($bingo))->start();

        $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Bingo has been started!')
                ->content('And go!')
                ->build()
        );
    }

    public function createBingoSelect(): Option
    {
        $select = (new option($this->discord()))
            ->setName('bingo')
            ->setDescription('Set bingo name')
            ->setType(Option::INTEGER)
            ->setRequired(true);

        Bingo::query()
            ->startable()
            ->get()
            ->each(
                fn(Bingo $bingo) => $select->addChoice($bingo->toChoice($this->discord()))
            );

        return $select;
    }
}
