<?php

namespace App\Modules\Pets\Library\Repository;

use App\Modules\Pets\Models\Pet;

class PetRepository
{
    /**
     * @param string $id
     * @return Pet
     */
    public function find(string $id): Pet
    {
        return Pet::query()->findOrFail($id);
    }
}
