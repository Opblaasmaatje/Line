<?php

namespace App\Points\Facade;

use App\Models\Account;
use App\Models\Snapshot;
use App\Points\PointAllocator;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void boss(Snapshot $snapshot)
 * @method static void skill(Snapshot $snapshot)
 * @see PointAllocator
 */
class PointAllocation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PointAllocator::class;
    }
}
