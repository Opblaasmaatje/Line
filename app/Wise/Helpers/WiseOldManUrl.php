<?php

namespace App\Wise\Helpers;

use Illuminate\Support\Facades\Config;
use Spatie\Url\Url;

// TODO create tests.
class WiseOldManUrl
{
    public static function forCompetition(string $id): string
    {
        return Url::fromString(Config::get('wise-old-man.url'))
            ->withPath("/competitions/$id");
    }

    public static function forPlayer(string $username): string
    {
        $username = rawurlencode($username);

        return Url::fromString(Config::get('wise-old-man.url'))
            ->withPath("/players/{$username}");
    }
}
