<?php

namespace App\SlashCommands;

use App\Models\Account;
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
            (new option($this->discord()))
                ->setName('User')
                ->setDescription('Define which user')
                ->setType(Option::USER)
                ->setRequired(true),

            (new option($this->discord()))
                ->setName('Account RSN')
                ->setDescription('Define RSN')
                ->setType(Option::STRING)
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        $user = User::query()->updateOrCreate([
            'discord_id' => $this->value('user'),
        ]);

        Account::query()->updateOrCreate(
            [
                'user_id' => $user->getKey(),
            ],
            [
                'username' => $this->value('account-rsn'),
            ]
        );

        $interaction->respondWithMessage(
            $this
                ->message()
                ->title('Example')
                ->content('Hello world!')
                ->build()
        );
    }
}
