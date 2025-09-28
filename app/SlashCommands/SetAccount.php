<?php

namespace App\SlashCommands;

use App\Models\User;
use Discord\Parts\Interactions\Command\Option;
use Laracord\Commands\SlashCommand;

class SetAccount extends SlashCommand
{
    protected $name = 'set-account';

    protected $description = 'Set an account to a discord user.';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            (new Option($this->discord()))
                ->setName('User')
                ->setDescription('Define which user')
                ->setType(Option::USER)
                ->setRequired(true),

            (new Option($this->discord()))
                ->setName('Account RSN')
                ->setDescription('Define RSN')
                ->setType(Option::STRING)
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        /** @var User $user */
        $user = User::query()
            ->with('account')
            ->updateOrCreate([
                'discord_id' => $this->value('user'),
            ]);

        $user->account()->updateOrCreate([], values: [
            'username' => $this->value('account-rsn'),
        ]);

        return $interaction->respondWithMessage(
            $this
                ->message('Account information updated!')
                ->success()
                ->field('URL', $user->account->url)
                ->field('RSN', $user->account->username)
                ->content("{$interaction->user->username} had their account information updated!")
                ->build()
        );
    }
}
