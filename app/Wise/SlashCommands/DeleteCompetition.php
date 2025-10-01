<?php

namespace App\Wise\SlashCommands;

use App\Laracord\Option;
use Laracord\Commands\SlashCommand;

class DeleteCompetition extends SlashCommand
{
    protected $name = 'delete-competition';

    protected $description = 'Delete a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setName('competition')
                ->setType(Option::STRING)
                ->setDescription('Define the competition to delete')
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        dd($this->value('competition'));;

        // TODO: Implement handle() method.
    }
}
