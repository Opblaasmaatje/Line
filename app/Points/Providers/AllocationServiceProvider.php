<?php

namespace App\Points\Providers;

use App\Points\Configuration\BossPointAllocation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AllocationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(BossPointAllocation::class, function (){
            return new BossPointAllocation(
                Config::get('points.bosses')
            );
        });
    }
}
