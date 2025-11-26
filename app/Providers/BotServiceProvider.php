<?php

namespace App\Providers;

use App\Laracord\ModuleLoader\Facade\Commands;
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

        config([
            'discord.commands' => Commands::getActiveCommands()->toArray(),
        ]);
    }
}
