<?php

namespace App\SlashCommands;

use App\Library\Services\AccountService;
use App\Library\Services\UserService;
use App\Models\Account;
use App\Models\User;
use App\Repository\UserRepository;
use Discord\Parts\Interactions\Command\Option;
use Illuminate\Support\Facades\App;
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
        $user = $this->userRepository()->setUserByDiscordId(
            $this->value('user')
        );

        /** @var Account|false $account */
        $account = $this->accountService()->assignAccount(
            $user,
            $this->value('account-rsn'),
        );


        if(! $account){
            return $interaction->respondWithMessage(
                $this
                    ->message('Failure assigning account')
                    ->error()
                    ->content("Could not assign account with name [{$this->value('account-rsn')}]")
                    ->build()
            );
        }

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

    protected function userRepository(): UserRepository
    {
        return App::make(UserRepository::class);
    }

    protected function accountService(): AccountService
    {
        return App::make(AccountService::class);
    }
}
