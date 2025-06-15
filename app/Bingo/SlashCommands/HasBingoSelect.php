<?php

namespace App\Bingo\SlashCommands;

use App\Bingo\Models\Bingo;
use Discord\Parts\Interactions\Command\Option;

trait HasBingoSelect
{
    protected function createBingoSelect(): Option
    {
        $select = (new option($this->discord()))
            ->setName('bingo')
            ->setDescription('Define the bingo')
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
