<?php

namespace App\Laracord\SlashCommands;

use Laracord\Commands\SlashCommand;
use Laracord\Laracord;

abstract class BaseSlashCommand extends SlashCommand
{
    private array $beforeCallbacks = [];

    public function __construct(Laracord $bot)
    {
        parent::__construct($bot);

        $this->bootTraits();
    }

    private function bootTraits(): void
    {
        foreach (class_uses_recursive(static::class) as $trait) {
            $method = 'boot'.class_basename($trait);

            if (method_exists($this, $method)) {
                $this->{$method}();
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function maybeHandle($interaction)
    {
        if (! $this->isAdminCommand()) {
            $this->parseOptions($interaction);

            $this->handleBeforeCallbacks($interaction);

            $this->handle($interaction);

            $this->clearOptions();
        }

        if ($this->isAdminCommand() && ! $this->isAdmin($interaction->member?->user)) {
            return $interaction->respondWithMessage(
                $this
                    ->message('You do not have permission to run this command.')
                    ->title('Permission Denied')
                    ->error()
                    ->build(),
                ephemeral: true
            );
        }

        $this->parseOptions($interaction);

        $this->handleBeforeCallbacks($interaction);

        $this->handle($interaction);

        $this->clearOptions();
    }

    protected function handleBeforeCallbacks($interaction): self
    {
        foreach ($this->beforeCallbacks as $callback) {
            $callback($interaction);
        }

        return $this;
    }

    public function addBeforeCallback(callable $callback): self
    {
        $this->beforeCallbacks[] = $callback;

        return $this;
    }
}
