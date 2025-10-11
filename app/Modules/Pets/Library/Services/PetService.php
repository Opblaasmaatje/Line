<?php

namespace App\Modules\Pets\Library\Services;

use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use App\Modules\Pets\Models\Pet;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class PetService
{
   public function createPet(Account $account, PetName $pet, File $image): Pet
   {
       Storage::putFile("public/pets/proof/$account->id/", $image);

       return $account->pets()->create([
        'name' => $pet,
           'status' => Status::IN_PROCESS,
           'image' => Storage::url("public/pets/proof/$account->id/$image"),
    ]);
   }
}
