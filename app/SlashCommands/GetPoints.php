<?php

namespace App\SlashCommands;

use App\Models\User;
use Discord\Parts\Interactions\Command\Option;
use Laracord\Commands\SlashCommand;

class GetPoints extends SlashCommand
{
    protected $name = 'points';

    protected $description = 'Check user stats';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            (new option($this->discord()))
                ->setName('User')
                ->setDescription("Who's points do you want to know?")
                ->setType(Option::USER)
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        $account = User::repository()->findAccount($this->option('user.value'));

        if (is_null($account)) {
            return $interaction->respondWithMessage(
                $this
                    ->message('You do not have an account attached.')
                    ->title('No associated account found!')
                    ->build()
            );
        }

        return $interaction->respondWithMessage(
            $this->message()
                ->info()
                ->title('These are you total points!')
                ->field('points', $account->total_points)
                ->build()
        );
    }
}
