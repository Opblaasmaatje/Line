<<<<<<< ours
<?php

namespace App\Console\Commands;

use Laracord\Console\Commands\TokenMakeCommand as BaseTokenMakeCommand;

class TokenMakeCommand extends BaseTokenMakeCommand
{
    protected function handleToken(bool $force = false): void
    {
        $tokens = $this->getTokens();

<<<<<<< ours
        if (! method_exists($this->user, 'createToken')) {
            $this->components->error('User cannot make API keys!');

            return;
        }

||||||| ancestor
=======
        if(! $this->user instanceof HasApiTokens){
            $this->components->error("User cannot make API keys!.");

            return;
        }

>>>>>>> theirs
        if ($tokens->isNotEmpty() && ! $force) {
<<<<<<< ours
            $this->components->error("The user <fg=red>{$this->user->getKey()}</> already has a token.");



            return;
        }

        $token = $this->user->createToken('token', ['http'])->plainTextToken;

        $this->components->bulletList([$token]);
    }
}
|||||||
=======
<?php

namespace App\Console\Commands;

use Laracord\Console\Commands\TokenMakeCommand as BaseTokenMakeCommand;

class TokenMakeCommand extends BaseTokenMakeCommand
{
    protected function handleToken(bool $force = false): void
    {
        $tokens = $this->getTokens();
||||||| ancestor
            $this->components->error("The user <fg=red>{$this->user->id}</> already has a token.");
=======
            $this->components->error("The user <fg=red>{$this->user->getKey()}</> already has a token.");
>>>>>>> theirs

        if ($tokens->isNotEmpty() && ! $force) {
            $this->components->error("The user <fg=red>{$this->user->id}</> already has a token.");
            return;
        }

        $token = $this->user->createToken('token', ['http'])->plainTextToken;

        $this->components->bulletList([$token]);
    }
}
>>>>>>> theirs
