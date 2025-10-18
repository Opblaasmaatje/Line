<?php

namespace App\Modules\Pets\Library\Repository;

use App\Models\Account;
use App\Modules\Pets\Models\Pet;
use Illuminate\Support\Collection;

class PetRepository
{
    public function find(string $id): Pet
    {
        return Pet::query()->findOrFail($id);
    }

    /**
     * @param Account $account
     * @return Collection<Pet>
     */
    public function getApprovedPets(Account $account): Collection
    {
        return Pet::query()
            ->whereBelongsTo($account)
            ->approved()
            ->get();
    }
}
