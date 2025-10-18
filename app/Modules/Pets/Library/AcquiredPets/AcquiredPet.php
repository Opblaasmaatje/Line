<?php

namespace App\Modules\Pets\Library\AcquiredPets;

use App\Modules\Pets\Models\Enums\PetName;

readonly class AcquiredPet
{
    public function __construct(
        public PetName $name,
        public bool $acquired,
    ) {
    }
}
