<?php

namespace App\Modules\Points\Providers;

use App\Modules\Points\Configuration\PointAllocationConfiguration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AllocationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(PointAllocationConfiguration::class, function () {
            return new PointAllocationConfiguration(
                bossConfig: Config::get('points.bosses'),
                skillConfig: Config::get('points.skills'),
            );
        });
    }
}
