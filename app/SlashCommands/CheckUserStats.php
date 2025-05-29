<?php

namespace App\SlashCommands;

use App\Models\User;
use Laracord\Commands\SlashCommand;

class CheckUserStats extends SlashCommand
{
    protected $name = 'check-user-stats';

    protected $description = 'Check user stats';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function handle($interaction)
    {
        /** @var User|null $user */
        $user = User::query()->where('discord_id', $interaction->user->id)->first();

        if (is_null($user)) {
            return $interaction->respondWithMessage(
                $this->message('aaha')->title('No user found!')->build()
            );
        }

        $kills = $user->account->details->latestSnapshot->data->bosses->commander_zilyana->kills;

        return $interaction->respondWithMessage(
            $this->message((string) "Zilyana kills: $kills")
                ->title("{$user->account->username} Found!")
                ->content((string) "Zilyana kills: $kills")
                ->build()
        );

    }
}
