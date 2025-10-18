<?php

namespace App\Laracord\SlashCommands;

use Laracord\Commands\SlashCommand;
use Laracord\Laracord;

abstract class BaseSlashCommand extends SlashCommand
{
    /**
     * @var ValidatableCallback[]
     */
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
    public function maybeHandle($interaction): void
    {
        /** @phpstan-ignore-next-line */
        if ($this->isAdminCommand() && ! $this->isAdmin($interaction->member->user)) {
            $interaction->respondWithMessage(
                $this
                    ->message('You do not have permission to run this command.')
                    ->title('Permission Denied')
                    ->error()
                    ->build(),
                ephemeral: true
            );

            return;
        }

        $this->parseOptions($interaction);

        if (! $this->handleBeforeCallbacks($interaction)) {
            return;
        }

        $this->handle($interaction);

        $this->clearOptions();
    }

    protected function handleBeforeCallbacks($interaction): bool
    {
        return collect($this->beforeCallbacks)->every(function (ValidatableCallback $callback) use ($interaction) {
            return $callback->validate($interaction);
        });
    }

    public function addBeforeCallback(ValidatableCallback $callback): self
    {
        $this->beforeCallbacks[] = $callback;

        return $this;
    }
}
