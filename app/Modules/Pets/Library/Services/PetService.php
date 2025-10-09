<?php

namespace App\Modules\Pets\Library\Services;


use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use App\Modules\Pets\Models\Pet;

class PetService
{
   public function createPet(Account $account, PetName $pet): Pet
   {
       return $account->pets()->create([
           'name' => $pet,
           'status' => Status::IN_PROCESS
       ]);
   }
}
