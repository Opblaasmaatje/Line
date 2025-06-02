<?php

namespace App\Wise\Facade;

use App\Wise\Client\Players\DTO\PlayerSnapshot;
use App\Wise\Client\Players\PlayerClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PlayerSnapshot details(string $username)
 */
class WiseOldManPlayer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PlayerClient::class;
    }
}
