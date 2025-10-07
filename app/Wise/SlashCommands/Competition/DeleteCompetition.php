<?php

namespace App\Wise\SlashCommands\Competition;

use App\Laracord\Option;
use App\Library\Services\CompetitionService;
use App\Models\Competition;
use App\Wise\SlashCommands\Concerns\HasCompetition;
use Discord\Parts\Interactions\ApplicationCommandAutocomplete;
use Illuminate\Support\Facades\App;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laracord\Commands\SlashCommand;

class DeleteCompetition extends SlashCommand
{
    use HasCompetition;

    protected $name = 'delete-competition';

    protected $description = 'Delete a competition';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            $this->getCompetitionOption($this->discord()),
        ];
    }

    public function handle($interaction)
    {
        $success = $this->getCompetitionService()->delete(
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
            'competition' => $this->getCompetitionAutocomplete(),
        ];
    }

    protected function getCompetitionService(): CompetitionService
    {
        return App::make(CompetitionService::class);
    }
}
