<?php

namespace App\Bingo\SlashCommands;

use App\Bingo\BingoHandler;
use App\Bingo\Models\Bingo;
use App\Bingo\Models\Objective;
use App\Bingo\Models\Objectives\Submission;
use Discord\Parts\Interactions\Command\Option;
use Laracord\Commands\SlashCommand;

class AddSubmissionObjective extends SlashCommand
{
    use HasBingoSelect;

    protected $name = 'add-submission-objective';

    protected $description = 'Adds submission objectives for all teams';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        $bingoSelect = $this->createBingoSelect();

        return [
            $bingoSelect,

            (new Option($this->discord()))
                ->setName('Objective name')
                ->setDescription('Objective description')
                ->setType(Option::STRING)
                ->setRequired(true)
        ];
    }

    public function handle($interaction): void
    {
        $bingo = Bingo::query()->findOrFail($this->value('bingo'));

        $submission = (new Submission([
            'name' => $this->value('objective-name'),
        ]));

        $submission->save();

        (new BingoHandler($bingo))->addObjective(
            (new Objective())
                ->task()
                ->associate($submission)
        );

        $interaction->respondWithMessage(
            $this
                ->message()
                ->success()
                ->title('Objective has been added!')
                ->content("Added [{$this->value('objective-name')}]!")
                ->build()
        );
    }
}
