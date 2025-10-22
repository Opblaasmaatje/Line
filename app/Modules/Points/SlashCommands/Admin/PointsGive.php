<?php

namespace App\Modules\Points\SlashCommands\Admin;

use App\Laracord\Option;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Modules\Points\Jobs\Actions\ApplyPoints;
use App\SlashCommands\Parameters\HasAccount;

class PointsGive extends BaseSlashCommand
{
    use HasAccount;
    use AdminCommand;

    protected $name = 'points-give';

    protected $description = 'Manually give points to account';

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setName('source')
                ->setDescription('Set the source of the points')
                ->setType(Option::STRING)
                ->setRequired(true),

            $this->getAccountOption($this->discord()),

            Option::make($this->discord())
                ->setName('Amount')
                ->setDescription('How many points do you want to assign?')
                ->setType(Option::INTEGER)
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        (new ApplyPoints)->run(
            account: $this->account,
            metric: $this->option('source.value'),
            amount: $this->option('amount.value')
        );

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Successfully given points!')
                ->content("Give {$this->account->username} {$this->option('amount.value')} points for {$this->option('source.value')}")
                ->build()
        );
    }
}
