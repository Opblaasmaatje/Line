<?php

namespace App\Modules\GooseBoards\SlashCommands\Admin;

use App\Laracord\Option;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Laracord\SlashCommands\SlashCommandWithRuleValidation;
use App\Modules\GooseBoards\Library\Services\GooseBoardService;
use Carbon\CarbonPeriodImmutable;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use React\Promise\PromiseInterface;

class GooseBoardCreate extends SlashCommandWithRuleValidation
{
    use AdminCommand;

    protected $name = 'gb-create';

    protected $description = 'Create a goose board.';

    protected function action(ApplicationCommand|Ping $interaction): PromiseInterface
    {
        $gooseBoard = $this->gooseBoardService()->create(
            $this->value('name'),
            CarbonPeriodImmutable::create(
                $this->value('start-date'),
                $this->value('end-date')
            )
        );

        return $this
            ->message('Use the following commands to configure the goose board!')
            ->field('Add tile', '', false)
            ->field('Remove tile', '', false)
            ->field('Add team', '', false)
            ->field('Remove team', '', false)
            ->field('Add team member', '', false)
            ->field('Remove team member', '', false)
            ->success()
            ->reply($interaction);
    }

    protected function gooseBoardService(): GooseBoardService
    {
        return App::make(GooseBoardService::class);
    }

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setName('name')
                ->setDescription('Define the name of the goose board')
                ->setType(Option::STRING)
                ->setRequired(true),

            Option::make($this->discord())
                ->setName('start-date')
                ->setDescription('Define the starting date in dd-mm-yyyy format')
                ->setType(Option::STRING)
                ->setRequired(true),

            Option::make($this->discord())
                ->setName('end-date')
                ->setDescription('Define the ending date in dd-mm-yyyy format')
                ->setType(Option::STRING)
                ->setRequired(true),
        ];
    }

    protected function getValidationRules(): array
    {
        return [
            'start-date' => [
                'required',
                Rule::date()->format('d-m-Y'),
                'after:today',
                'before:end-date',
            ],
            'end-date' => [
                'required',
                Rule::date()->format('d-m-Y'),
                'after:start-date',
            ],
        ];
    }

    protected function getValidationAttributes(): array
    {
        return [
            'start-date' => $this->value('start-date'),
            'end-date' => $this->value('end-date'),
            'name' => $this->value('name'),
        ];
    }
}
