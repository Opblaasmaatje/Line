<?php

namespace App\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Library\Services\AccountService;
use App\SlashCommands\Parameters\HasAccount;
use App\SlashCommands\Parameters\HasMetric;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Record;
use Illuminate\Support\Facades\App;
use React\Promise\PromiseInterface;

class GetRecords extends BaseSlashCommand
{
    use HasAccount;
    use HasMetric;

    protected $name = 'records';

    protected $description = 'Get the records of an account.';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            $this->getAccountOption($this->discord()),
            $this->getMetricOption($this->discord()),
        ];
    }

    public function handle($interaction): PromiseInterface
    {
        $records = $this->accountService()->records(
            $this->account,
            $this->metric,
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
                ->content("Here are {$this->account->username}'s records for the [{$this->value('metric')}] metric!")
                ->build(),
        );
    }

    protected function accountService(): AccountService
    {
        return App::make(AccountService::class);
    }

    public function autocomplete(): array
    {
        return [
            'metric' => $this->getMetricAutoCompleteCallback(),
        ];
    }
}
