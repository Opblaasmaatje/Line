<?php

namespace App\Providers;

use BeyondCode\ErdGenerator\ErdGeneratorServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Laracord\LaracordServiceProvider;

class BotServiceProvider extends LaracordServiceProvider
{

    public function boot()
    {
        parent::boot();

        Model::shouldBeStrict();

        if ($this->app->environment('local')) {
            $this->app->register(ErdGeneratorServiceProvider::class);
        }
    }

    public function register()
    {
        parent::register();
    }
}
