<?php

namespace App\Points\SlashCommands;

use App\Models\User;
use App\Points\Jobs\Actions\ApplyPoints;
use Discord\Parts\Interactions\Command\Option;
use Discord\Parts\Interactions\Interaction;
use Laracord\Commands\SlashCommand;

class GivePoints extends SlashCommand
{
    protected $name = 'give-points';

    protected $description = 'Manually give points to account';

    protected $options = [];

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            (new Option($this->discord()))
                ->setName('source')
                ->setDescription('Set the source of the points')
                ->setType(Option::STRING)
                ->setRequired(true),

            (new Option($this->discord()))
                ->setName('User')
                ->setDescription('Who do you want to assign the points to?')
                ->setType(Option::USER)
                ->setRequired(true),

            (new Option($this->discord()))
                ->setName('Amount')
                ->setDescription('How many points do you want to assign?')
                ->setType(Option::INTEGER)
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        $account = User::repository()->findAccount($this->option('user.value'));

        if (is_null($account)) {
            return $interaction->respondWithMessage(
                $this
                    ->message('No Account was found!')
                    ->title('No associated account found!')
                    ->build()
            );
        }

        (new ApplyPoints)->run(
            account: $account,
            metric: $this->option('source.value'),
            amount: $this->option('amount.value')
        );

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Successfully given points!')
                ->content("Give {$account->username} {$this->option('amount.value')} points for {$this->option('source.value')}")
                ->build()
        );
    }

    public function interactions(): array
    {
        return [
            'wave' => fn(Interaction $interaction) => $this->message('👋')->reply($interaction),
        ];
    }
}
