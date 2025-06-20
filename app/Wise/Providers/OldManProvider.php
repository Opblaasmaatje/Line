<?php

namespace App\Wise\Providers;

use App\Wise\Client\OldMan;
use Brick\JsonMapper\JsonMapper;
use Brick\JsonMapper\OnExtraProperties;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class OldManProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(JsonMapper::class, function (){
            return new JsonMapper(onExtraProperties: OnExtraProperties::IGNORE);
        });

        $this->app->bind(OldMan::class, function (){
            $client = Http::baseUrl(Config::get('wise.old-man.url'));

            return new OldMan(
                client: $client,
                apiKey: Config::get('wise.old-man.api-key'),
                groupId: Config::get('wise.old-man.group-id'),
                groupCode: Config::get('wise.old-man.group-code'),
            );
        });
    }
}
