<?php

namespace App\Wise\Providers;

use App\Wise\Client\GroupConfiguration;
use App\Wise\WiseOldMan;
use Brick\JsonMapper\JsonMapper;
use Brick\JsonMapper\OnExtraProperties;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Spatie\GuzzleRateLimiterMiddleware\RateLimiterMiddleware;

class OldManProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(JsonMapper::class, function () {
            return new JsonMapper(onExtraProperties: OnExtraProperties::IGNORE);
        });

        $this->app->bind(WiseOldMan::class, function () {
            $client = Http::baseUrl(Config::get('wise-old-man.api-url'))
                ->withMiddleware(RateLimiterMiddleware::perSecond(5));

            $groupConfiguration = new GroupConfiguration(
                Config::get('wise-old-man.group-code'),
                Config::get('wise-old-man.group-id')
            );

            return new WiseOldMan(
                $client,
                $groupConfiguration
            );
        });
    }
}
