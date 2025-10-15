<?php

namespace Tests\Unit\Modules\Pets\Helpers;


use App\Modules\Pets\Models\Enums\Status;

trait TestsPetStatuses
{
    public static function statuses(): array
    {
        return [
            ...collect(Status::cases())
                ->map(fn (Status $status) => [$status]),
        ];
    }
}
