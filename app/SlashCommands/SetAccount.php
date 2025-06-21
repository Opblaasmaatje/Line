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
        User::query()
            ->updateOrCreate([
                'discord_id' => $this->value('user'),
            ])
            ->account()
            ->updateOrCreate([], values: [
                'username' => $this->value('account-rsn'),
            ]);

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Account information updated!')
                ->content("{$interaction->user->username} had their account information updated to [{$this->value('account-rsn')}]")
                ->build()
        );
    }
}
