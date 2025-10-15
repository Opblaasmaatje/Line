<?php

namespace Tests\Unit\Modules\Pets\Helpers;

use App\Modules\Pets\Models\Enums\PetName;

trait TestsPetNames
{
    public static function pets(): array
    {
        return [
            ...collect(PetName::cases())
                ->map(fn (PetName $petName) => [$petName]),
        ];
    }
}
