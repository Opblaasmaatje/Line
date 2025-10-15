<?php

namespace App\Modules\Pets\Library\Services;

use App\Models\Account;
use App\Modules\Pets\Library\Repository\PetRepository;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use App\Modules\Pets\Models\Pet;

class PetService
{
    public function __construct(
        public readonly PetRepository $repository
    ){
    }

    public function createPet(Account $account, PetName $pet, string $imageUrl): Pet
    {
       /** @var Pet $pet */
       $pet = $account->pets()->create([
            'name' => $pet,
           'status' => Status::IN_PROCESS,
           'image_url' => $imageUrl,
    ]);

       return $pet->refresh();
   }

    public function approve(Pet $pet): Pet
    {
        return $this->setStatus($pet, Status::APPROVED);
    }

    protected function setStatus(Pet $pet, Status $status): Pet
    {
        $pet->fill(['status' => $status])->save();

        return $pet->refresh();
    }

    public function reject(Pet $pet): Pet
    {
        return $this->setStatus($pet, Status::REJECTED);
    }
}
