<?php

namespace App\Modules\Pets\SlashCommands;

use App\Laracord\SlashCommands\SlashCommandWithAccount;
use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\SlashCommands\Concerns\HasPet;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Ping;
use React\Promise\PromiseInterface;

class SubmitPet extends SlashCommandWithAccount
{
    use HasPet;

    protected $name = 'pet-submit';

    protected $description = 'Submit a pet';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return array_merge(parent::options(), [
            $this->getPetOption($this->discord()),
        ]);
    }

    protected function action(ApplicationCommand|Ping $interaction, Account $account): PromiseInterface
    {
        $pet = $this->getPetService()->createPet(
            $account,
            PetName::from($this->value('pet'))
        );

        return $interaction->respondWithMessage(
            $this
                ->message("Submitted pet approval for {$pet->name->toHeadline()}.")
                ->success()
                ->content('An admin will approve or deny your pet submission.')
                ->build()
        );
    }

    public function autocomplete(): array
    {
        return [
            'pet' => $this->getPetAutocompletion(),
        ];
    }
}
