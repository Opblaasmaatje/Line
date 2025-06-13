<?php

namespace App\Bingo\Services;

use App\Bingo\SlashCommands\StartBingo;
use Laracord\Services\Service;

class ReloadCommandsOptions extends Service
{
    protected int $interval = 5;

    public function handle(): void
    {
       $this->console()->log('Reloading commands');

       $this->discord()->application->commands->save(
           (new StartBingo($this->bot))->create(),
           'Need new information of things'
       );
    }
}
