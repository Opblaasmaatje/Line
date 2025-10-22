<?php

namespace App;

use App\Cron\UpdateBotActivity;
use App\Modules\GooseBoards\Http\Controllers\GooseBoardController;
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
        Route::middleware('api')->group(function () {
            Route::post('goose-board', [GooseBoardController::class, 'create']);
        });
    }
}
