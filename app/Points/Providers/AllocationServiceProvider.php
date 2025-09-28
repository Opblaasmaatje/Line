<?php

namespace App\Points\Providers;

use App\Points\Configuration\PointAllocationConfiguration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AllocationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(PointAllocationConfiguration::class, function () {
            return new PointAllocationConfiguration(
                bossConfig: Config::get('points.bosses'),
                skillConfig: Config::get('points.skills'),
            );
        });
    }
}
