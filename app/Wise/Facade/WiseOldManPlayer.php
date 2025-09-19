<?php

namespace App\Wise\Facade;

use App\Wise\Client\Endpoints\Players\DTO\PlayerSnapshot;
use App\Wise\Client\Endpoints\Players\PlayerEndpoint;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PlayerSnapshot details(string $username)
 *
 * @see PlayerEndpoint
 */
class WiseOldManPlayer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PlayerEndpoint::class;
    }
}
