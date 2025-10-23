<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Laracord\LaracordServiceProvider;

class BotServiceProvider extends LaracordServiceProvider
{
    public function boot()
    {
        parent::boot();

        Model::shouldBeStrict();
    }

    public function register()
    {
        parent::register();
    }
}
