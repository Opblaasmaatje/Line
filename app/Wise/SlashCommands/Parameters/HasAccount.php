<?php

namespace App\Wise\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Laracord\SlashCommands\ValidatableCallback;
use App\Library\Repository\UserRepository;
use App\Models\Account;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\Interaction;
use Illuminate\Support\Facades\App;

trait
HasAccount
{
    protected Account $account;

    public function getAccountOption(DiscordCommandClient $client): Option
    {
        return Option::make($client)
            ->setName('User')
            ->setDescription('Decide the account of a user.')
            ->setType(Option::USER)
            ->setRequired(true);
    }

    private function userRepository(): UserRepository
    {
        return App::make(UserRepository::class);
    }

    protected function bootHasAccount(): void
    {
        $validatableCallback = new ValidatableCallback(function (Interaction $interaction) {
            if (! $this->value('user')) {
                $interaction->respondWithMessage(
                    $this
                        ->message('User was not given as parameter!')
                        ->error()
                        ->content('User was not given as parameter!')
                        ->build()
                );

                return false;
            }

            $account = $this->userRepository()->findAccount(
                $this->value('user')
            );

            if (! $account) {
                $interaction->respondWithMessage(
                    $this
                        ->message('User does not have an account assigned')
                        ->warning()
                        ->content('Please use the set account command to assign the user an account!')
                        ->build()
                );

                return false;
            }

            $this->account = $account;

            return true;
        });

        $this->addBeforeCallback($validatableCallback);
    }
}
