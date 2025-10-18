<?php

namespace App\Cron;

use App\Helpers\Items;
use Discord\Parts\User\Activity;
use Laracord\Services\Service;

class UpdateBotActivity extends Service
{
    protected int $interval = 100;

    public function handle(): void
    {
        /** @var Activity $activity */
        $activity = $this->discord()->factory(Activity::class, [
            'type' => Activity::TYPE_GAME,
            'name' => Items::getOne()['name'],
        ]);

        $this->console()->log("Updating bot activity with {$activity->name}");

        $this->discord()->updatePresence($activity);
    }
}
