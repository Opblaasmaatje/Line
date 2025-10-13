<?php

namespace App\Modules\Pets\Library\Services;

use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use App\Modules\Pets\Models\Pet;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PetService
{
    /**
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function createPet(Account $account, PetName $pet, string $imageUrl): Pet
    {
       /** @var Pet $pet */
       $pet = $account->pets()->create([
        'name' => $pet,
           'status' => Status::IN_PROCESS,
    ]);

       $pet->addMediaFromUrl($imageUrl)->toMediaCollection('pets');

       return $pet->refresh();
   }
}
