<?php

namespace App\Modules\Pets\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\Pets\Library\AcquiredPets\AcquiredPet;
use App\Modules\Pets\Library\Services\PetService;
use App\Wise\SlashCommands\Parameters\HasAccount;
use Illuminate\Support\Facades\App;

class CheckPets extends BaseSlashCommand
{
    use HasAccount;

    protected $name = 'pet-check';

    protected $description = 'Check pets of a user';

    public function options(): array
    {
        return [
            $this->getAccountOption($this->discord())
        ];
    }

    public function handle($interaction)
    {
        $collection = $this->getPetService()->getAcquiredPets($this->account);

        $message = $this
            ->message("A total of {$collection->onlyGotten()->count()}/{$collection->acquiredPets->count()}")
            ->title("These are all the pets {$this->account->username} has!")
            ->success();

        $collection->onlyGotten()->each(function (AcquiredPet $pet) use ($message){
            return $message->field($pet->name->value, '✅');
        });

        return $interaction->respondWithMessage($message->build());
    }

    protected function getPetService(): PetService
    {
        return App::make(PetService::class);
    }
}
