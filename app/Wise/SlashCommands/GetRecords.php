<?php

namespace App\Wise\SlashCommands;

use App\Laracord\Option;
use App\Laracord\SlashCommands\SlashCommandWithAccount;
use App\Library\Repository\UserRepository;
use App\Library\Services\AccountService;
use App\Models\Account;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Record;
use App\Wise\Client\Enums\Metric;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\App;
use React\Promise\PromiseInterface;

class GetRecords extends SlashCommandWithAccount
{
    protected $name = 'records';

    protected $description = 'Get the records of an account.';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        $parentRules = parent::options();

        return array_merge($parentRules, [
            Option::make($this->discord())
                ->setName('Metric')
                ->setDescription('What metric do you want to know?')
                ->setType(Option::STRING)
                ->setAutoComplete(true)
                ->setRequired(true),
        ]);
    }

    protected function action(Ping|ApplicationCommand $interaction, Account $account): PromiseInterface
    {
        $records = $this->accountService()->records(
            $account,
            Metric::fromHeadline($this->value('metric')),
        );

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->fields(
                    $records->flatMap(fn (Record $record) => [
                        $record->period->toHeadline() => "$record->value",
                    ]),
                    false
                )
                ->content("Here are {$account->username}'s records for the [{$this->value('metric')}] metric!")
                ->build(),
        );
    }

    protected function userRepository(): UserRepository
    {
        return App::make(UserRepository::class);
    }

    protected function accountService(): AccountService
    {
        return App::make(AccountService::class);
    }

    public function autocomplete(): array
    {
        return [
            'metric' => fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
                ? Metric::search($value)
                    ->map(fn (Metric $metric) => $metric->toHeadline())
                    ->take(25)
                    ->values()
                    ->toArray()

                : collect(Metric::cases())
                    ->map(fn (Metric $metric) => $metric->toHeadline())
                    ->toArray(),
        ];
    }
}
