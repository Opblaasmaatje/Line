<?php

namespace App\Library\Repository;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CompetitionRepository
{
    /**
     * @var Builder<Competition>
     */
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

        return $this->query->where('title', $competition)->first();
    }

    public function likeTitle(string $value): Collection
    {
        return $this->query
            ->where('title', 'like', "%{$value}%")
            ->get();
    }

    public function get(): Collection
    {
        return $this->query->get();
    }
}
