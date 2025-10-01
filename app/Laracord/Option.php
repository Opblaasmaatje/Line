<?php

namespace App\Laracord;

use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\Command\Option as BaseOption;

class Option extends BaseOption
{
    public static function make(DiscordCommandClient $client): Option
    {
        return new self($client);
    }
}
