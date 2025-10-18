<?php

namespace App;

use App\Cron\UpdateBotActivity;
use App\Livewire\Message;
use Illuminate\Foundation\Console\NotificationMakeCommand;
use Illuminate\Support\Facades\Route;
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
        Route::middleware('web')->group(function () {
            Route::get('/message', Message::class);
        });

    }
}
