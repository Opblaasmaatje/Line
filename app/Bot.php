<?php

namespace App;

use App\Cron\UpdateBotActivity;
use Laracord\Laracord;

class Bot extends Laracord
{
    protected function bootServices(): self
    {
        parent::bootServices();

        UpdateBotActivity::applyActivity($this->discord(), null);

        return $this;
    }

    public function routes(): void
    {
        //
    }
}
