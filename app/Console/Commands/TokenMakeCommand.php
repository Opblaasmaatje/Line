<?php

namespace App\Console\Commands;

use Laracord\Console\Commands\TokenMakeCommand as BaseTokenMakeCommand;

class TokenMakeCommand extends BaseTokenMakeCommand
{
    protected function handleToken(bool $force = false): void
    {
        $tokens = $this->getTokens();

        if ($tokens->isNotEmpty() && ! $force) {
            $this->components->error("The user <fg=red>{$this->user->id}</> already has a token.");
            return;
        }

        $token = $this->user->createToken('token', ['http'])->plainTextToken;

        $this->components->bulletList([$token]);
    }
}
