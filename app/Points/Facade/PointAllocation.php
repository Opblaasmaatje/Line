<?php

namespace App\Points\Facade;

use App\Models\Account;
use App\Points\PointAllocator;
use App\Wise\Client\Players\Objects\PlayerObject;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void boss(Account $account)
 * @method static void skill(Account $account)
 * @see PointAllocator
 */
class PointAllocation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PointAllocator::class;
    }
}
