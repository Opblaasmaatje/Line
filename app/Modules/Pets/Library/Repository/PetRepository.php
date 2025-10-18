<?php

namespace App\Modules\Pets\Library\Repository;

use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Pet;
use Illuminate\Support\Collection;

class PetRepository
{
    public function find(string $id): Pet
    {
        return Pet::query()->findOrFail($id);
    }

    /**
     * @return Collection<Pet>
     */
    public function getApprovedPets(Account $account): Collection
    {
        return Pet::query()
            ->whereBelongsTo($account)
            ->approved()
            ->get();
    }

    public function accountHasPet(Account $account, PetName $pet): ?Pet
    {
        return Pet::query()
            ->whereBelongsTo($account)
            ->where('name', $pet)
            ->approved()
            ->first();
    }
}
