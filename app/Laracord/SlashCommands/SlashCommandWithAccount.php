<?php

namespace App\Laracord\SlashCommands;

use App\Laracord\Option;
use App\Library\Repository\UserRepository;
use App\Models\Account;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\App;
use Laracord\Commands\SlashCommand;
use React\Promise\PromiseInterface;

abstract class SlashCommandWithAccount extends SlashCommand
{
    abstract protected function action(Ping|ApplicationCommand $interaction, Account $account): PromiseInterface;

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setName('User')
                ->setDescription("Who's points do you want to know?")
                ->setType(Option::USER)
                ->setRequired(true),
        ];
    }

    /**
     * @param Ping $interaction
     * @return mixed|PromiseInterface
     */
    final public function handle($interaction)
    {
        $account = $this->userRepository()->findAccount(
            $this->value('user')
        );

        if (! $account) {
            return $interaction->respondWithMessage(
                $this
                    ->message('User does not have an account assigned')
                    ->error()
                    ->content('Please use the set account command to assign the user an account!')
                    ->build()
            );
        }

        return $this->action($interaction, $account);
    }

    protected function userRepository(): UserRepository
    {
        return App::make(UserRepository::class);
    }
}
