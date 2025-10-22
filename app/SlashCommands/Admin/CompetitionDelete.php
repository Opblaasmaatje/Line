<?php

namespace App\SlashCommands\Admin;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Library\Services\CompetitionService;
use App\SlashCommands\Parameters\HasCompetition;
use Illuminate\Support\Facades\App;

class CompetitionDelete extends BaseSlashCommand
{
    use HasCompetition;
    use AdminCommand;

    protected $name = 'competition-delete';

    protected $description = 'Delete a competition';

    public function options(): array
    {
        return [
            $this->getCompetitionOption($this->discord()),
        ];
    }

    public function handle($interaction)
    {
        $success = $this->getCompetitionService()->delete(
            $this->competition
        );

        if (! $success) {
            return $interaction->respondWithMessage(
                $this
                    ->message()
                    ->error()
                    ->title('Could not delete competition!')
                    ->field('Competition Title', $this->competition->title)
                    ->build()
            );
        }

        return $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Competition deleted!')
                ->field('Competition Title', $this->competition->title)
                ->build(),
        );
    }

    public function autocomplete(): array
    {
        return [
            'competition' => $this->getCompetitionAutocompleteCallback(),
        ];
    }

    protected function getCompetitionService(): CompetitionService
    {
        return App::make(CompetitionService::class);
    }
}
