<?php

namespace App\Library\Repository;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Builder;

class CompetitionRepository
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = Competition::query();
    }

    public function byTitle(Competition|string $competition): Competition|null
    {
        if ($competition instanceof Competition) {
            return $competition;
        }

        /** @var Competition $model */
        $model = $this->query->where('title', $competition)->first();

        return $model;
    }
}
