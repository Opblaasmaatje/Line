<?php

namespace App\Laracord\ModuleLoader\Facade;

use App\Laracord\ModuleLoader\Loader;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getActive()
 * @method static Collection getActiveCommands()
 */
class Commands extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Loader::class;
    }
}
