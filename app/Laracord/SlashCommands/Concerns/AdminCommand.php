<?php

namespace App\Laracord\SlashCommands\Concerns;

use Illuminate\Support\Str;

trait AdminCommand
{
    public function getName(): string
    {
        return Str::of($this->name)->prepend('admin-');
    }

    public function isAdminCommand(): bool
    {
        return true;
    }
}
