<?php

namespace App\Laracord\SlashCommands;

use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Laracord\Commands\SlashCommand;
use React\Promise\PromiseInterface;

abstract class SlashCommandWithRuleValidation extends SlashCommand
{
    abstract protected function action(Ping|ApplicationCommand $interaction): PromiseInterface;

    abstract protected function getValidationRules(): array;

    abstract protected function getValidationAttributes(): array;

    /**
     * @param Ping $interaction
     * @return mixed|PromiseInterface
     */
    final public function handle($interaction)
    {
        if ($this->validator()->fails()) {
            return $interaction->respondWithMessage(
                $this->message()
                    ->error()
                    ->title('Invalid payload!')
                    ->fields($this->validator()->errors()->all())
                    ->content('Please check command details')
                    ->build()
            );
        }

        return $this->action($interaction);
    }

    final protected function validator(): Validator
    {
        return ValidatorFacade::make(
            $this->getValidationAttributes(),
            $this->getValidationRules()
        );
    }
}
