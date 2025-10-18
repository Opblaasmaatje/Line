<?php

namespace App\Modules\Pets\Library\AcquiredPets;

use App\Modules\Pets\Models\Enums\PetName;
use Illuminate\Support\Collection;

readonly class AcquiredPetsCollection
{
    /**
     * @var Collection<AcquiredPet>
     */
    public Collection $acquiredPets;

    public function __construct(Collection $pets)
    {
        $allPets = collect(PetName::cases());

        $ownedNames = $pets->pluck('name');

        $this->acquiredPets = $allPets->map(
            fn(PetName $petName) => new AcquiredPet(
                $petName,
                $ownedNames->contains($petName),
            ),
        );
    }

    public function onlyGotten(): Collection
    {
        return $this->acquiredPets->filter(fn(AcquiredPet $pet) => $pet->acquired)->values();
    }

    public function onlyYetToGet(): Collection
    {
        return $this->acquiredPets->reject(fn(AcquiredPet $pet) => $pet->acquired)->values();
    }
}
