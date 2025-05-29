<?php

namespace App\SlashCommands;

use App\Models\Account;
use App\Models\User;
use Discord\Parts\Interactions\Command\Option;
use Laracord\Commands\SlashCommand;

class ApplyAccountToUser extends SlashCommand
{
    protected $name = 'apply-account-to-user';

    protected $description = 'The Apply Account to User slash command.';

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
