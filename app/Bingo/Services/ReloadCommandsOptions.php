<?php

namespace App\Bingo\Services;

use App\Bingo\SlashCommands\AddSubmissionObjective;
use App\Bingo\SlashCommands\StartBingo;
use Laracord\Services\Service;

class ReloadCommandsOptions extends Service
{
    protected int $interval = 20;

    public function handle(): void
    {
       $this->console()->log('Reloading commands');

       $this->discord()->application->commands->save(
           (new StartBingo($this->bot))->create(),
           'Need new information of things'
       );

        $this->discord()->application->commands->save(
            (new AddSubmissionObjective($this->bot))->create(),
            'Need new information of things'
        );
    }
}
