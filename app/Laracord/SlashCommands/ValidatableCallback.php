<?php

namespace App\Laracord\SlashCommands;

class ValidatableCallback
{
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function validate($interaction): bool
    {
        return ($this->callback)($interaction);
    }
}
