<?php

namespace App\Modules\Pets\Models\Queries;

use App\Modules\Pets\Models\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

class PetQuery extends Builder
{
    public function approved(): self
    {
        return $this->withStatus(Status::APPROVED);
    }

    public function inProcess(): self
    {
        return $this->withStatus(Status::IN_PROCESS);
    }

    public function rejected(): self
    {
        return $this->withStatus(Status::REJECTED);
    }

    protected function withStatus(Status $status): self
    {
        return $this->where('status', $status);
    }
}
