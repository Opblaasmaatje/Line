<?php

namespace App\Wise\SlashCommands;

use App\Laracord\Option;
use App\Library\Services\CompetitionService;
use App\Models\Competition;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Illuminate\Support\Facades\App;
use Laracord\Commands\SlashCommand;

class DeleteCompetition extends SlashCommand
{
    protected $name = 'delete-competition';

    protected $description = 'Delete a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setName('competition')
                ->setType(Option::STRING)
                ->setAutoComplete(true)
                ->setDescription('Define the competition to delete')
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        $success = App::make(CompetitionService::class)->delete(
            $this->value('competition')
        );

        if (! $success) {
            return $interaction->respondWithMessage(
                $this
                    ->message()
                    ->error()
                    ->title('Could not delete competition!')
                    ->field('Competition Title', $this->value('competition'))
                    ->build()
            );
        }

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Competition deleted!')
                ->field('Competition Title', $this->value('competition'))
                ->build(),
        );
    }

    public function autocomplete(): array
    {
        return [
            'competition' => fn (ApplicationCommandAutocomplete $autocomplete, mixed $value) => $value
                ? Competition::query()->where('title', 'like', "%{$value}%")->take(25)->pluck('title')->toArray()
                : Competition::query()->take(25)->pluck('title')->toArray(),
        ];
    }
}
