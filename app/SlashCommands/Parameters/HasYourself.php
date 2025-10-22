<?php

namespace App\SlashCommands\Parameters;

use App\Laracord\SlashCommands\ValidatableCallback;
use App\Models\Account;
use App\Models\User;
use Discord\Parts\Interactions\Interaction;

trait HasYourself
{
    protected Account $yourself;

    protected function bootHasYourself(): void
    {
        $validatableCallback = new ValidatableCallback(function (Interaction $interaction) {
            $account = User::repository()->findAccount($interaction->user->id);

            if (! $account) {
                $interaction->respondWithMessage(
                    $this
                        ->message('You do not have an account!')
                        ->warning()
                        ->content('Please ask an admin to set your account!')
                        ->build()
                );

                return false;
            }

            $this->yourself = $account;

            return true;
        });

        $this->addBeforeCallback($validatableCallback);
    }
}
