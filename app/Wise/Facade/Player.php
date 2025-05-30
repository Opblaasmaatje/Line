<?php

namespace App\Wise\Facade;

use App\Wise\Client\Players\Objects\PlayerObject;
use App\Wise\Client\Players\PlayerClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PlayerObject details(string $username)
 */
class Player extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PlayerClient::class;
    }
}
