<?php

namespace App\Wise\Helpers;

use Illuminate\Support\Facades\Config;
use Spatie\Url\Url;

class WiseOldManUrl
{
    public static function forCompetition(string $id): string
    {
        return Url::fromString(Config::get('wise.url'))
            ->withPath("/competitions/$id");
    }

    public static function forPlayer(string $username): string
    {
        $username = rawurlencode($username);

        return Url::fromString(Config::get('wise.url'))
            ->withPath("/players/{$username}");
    }
}
