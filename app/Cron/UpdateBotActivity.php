<?php

namespace App\Cron;

use App\Helpers\Items;
use Discord\DiscordCommandClient;
use Discord\Parts\User\Activity;
use Laracord\Console\Commands\BootCommand;
use Laracord\Services\Service;

class UpdateBotActivity extends Service
{
    protected int $interval = 100;

    public function handle(): void
    {
        self::applyActivity($this->discord(), $this->console());
    }

    public static function applyActivity(DiscordCommandClient $client, BootCommand|null $console): void
    {
        /** @var Activity $activity */
        $activity = $client->factory(Activity::class, [
            'type' => Activity::TYPE_GAME,
            'name' => Items::getOne()['name'],
        ]);

        if(! is_null($console)){
            $console->log("Updating bot activity with {$activity->name}");
        }

        $client->updatePresence($activity);
    }
}
