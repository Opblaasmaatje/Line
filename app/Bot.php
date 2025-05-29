<?php

namespace App;

use Illuminate\Support\Facades\Route;
use Laracord\Laracord;

class Bot extends Laracord
{
    public function routes(): void
    {
        Route::middleware('web')->group(function () {
        });

        Route::middleware('api')->group(function () {
        });
    }
}
