<?php

namespace App\Library\Repository;

use App\Models\Competition;

class CompetitionRepository
{
    public function byTitle(Competition|string $competition): Competition|null
    {
        if ($competition instanceof Competition) {
            return $competition;
        }

        return Competition::query()
            ->where('title', $competition)
            ->first();
    }
}
