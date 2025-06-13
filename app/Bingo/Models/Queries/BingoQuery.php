<?php

namespace App\Bingo\Models\Queries;


use Illuminate\Database\Eloquent\Builder;

class BingoQuery extends Builder
{
    public function startable(): self
    {
        return $this->where('has_started', false);
    }
}
