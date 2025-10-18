<?php

namespace App\Modules\Pets\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\SlashCommands\Parameters\HasPetName;
use App\Wise\SlashCommands\Parameters\HasAccount;
use Illuminate\Support\Facades\App;

class ProofPet extends BaseSlashCommand
{
    use HasAccount;
    use HasPetName;

    protected $name = 'proof-pet';

    protected $description = 'View proof of a pet submission';

    public function options(): array
    {
        return [
            $this->getAccountOption($this->discord()),
            $this->getPetNameOption($this->discord()),
        ];
    }

    public function handle($interaction)
    {
        $pet = $this->getPetService()->accountHasPet(
            $this->account,
            $this->petName,
        );

        if(is_null($pet)){
            return $interaction->respondWithMessage(
                $this
                ->message("{$this->account->username} does not have {$this->petName->value} 😔")
                ->warning()
                ->build()
            );
        }

        return $interaction->respondWithMessage(
            $this
                ->message("Here is proof of the pet submission for {$this->account->username}! 😊")
                ->imageUrl($pet->image_url)
                ->info()
                ->build()
        );
    }

    public function autocomplete(): array
    {
        return [
            'pet-name' => $this->getPetNameAutocompleteCallback(),
        ];
    }

    protected function getPetService(): PetService
    {
        return App::make(PetService::class);
    }
}
