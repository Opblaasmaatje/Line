<?php

namespace App\Modules\GooseBoards\SlashCommands;

use AllowDynamicProperties;
use App\Laracord\Button;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\GooseBoards\Library\Services\SubmissionService;
use App\Modules\GooseBoards\Library\Services\TeamService;
use App\Modules\GooseBoards\Library\Services\TileService;
use App\Modules\GooseBoards\Models\Submission;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;
use App\Wise\SlashCommands\Parameters\HasImage;
use App\Wise\SlashCommands\Parameters\HasYourself;
use Discord\Interaction;
use Discord\Parts\Interactions\MessageComponent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

#[AllowDynamicProperties]
class GooseBoardTileSubmit extends BaseSlashCommand
{
    use HasYourself;
    use HasGooseBoard;
    use HasImage;

    protected $name = 'goose-board-tile-submit';

    protected $description = 'Submit a tile completion for your team.';

    public function options(): array
    {
        return [
            $this->getGooseBoardOption($this->discord()),
            $this->getImageOption($this->discord())
        ];
    }

    public function handle($interaction)
    {
        $team = $this->getTeamService()->repository->findTeam(
            $this->yourself,
            $this->gooseBoard
        );

        if(! $team){
            return $interaction->respondWithMessage(
            $this
                    ->message('You are not in a team for this goose board!')
                    ->warning()
                    ->build(),
                true
            );
        }

        $submission = $this->getTeamService()->submit(
            $this->yourself,
            $team,
            $team->objective,
            $this->image->url,
        );

        return $interaction->respondWithMessage(
            $this
                ->message(':100: You submitted a tile for your team!')
                ->imageUrl($this->image->url)
                ->success()
                ->build()
        )
            ->then(fn () => $interaction->respondWithMessage(
                $this
                    ->message('Please review the following submission.')
                    ->title('Please review the following submission.')
                    ->content("
                        :small_blue_diamond: Team: {$submission->team->name}
                        :small_blue_diamond: Submitter: {$submission->account->username}
                        :small_blue_diamond: Objective: {$submission->tile->name}
                        :small_blue_diamond: Code: {$submission->team->verification_code}
                        :small_blue_diamond: Position: ({$submission->team->position}/{$this->gooseBoard->tiles->count()})
                    ")
                    ->info()
                    ->imageUrl($submission->image_url)
                    ->button(
                        label: 'Approve',
                        route: "approve:{$submission->getKey()}",
                    )
                    ->button(
                        label: 'Reject',
                        style: Button::STYLE_DANGER,
                        route: "reject:{$submission->getKey()}",
                    )
                    ->send(Config::get('app.pet.discord-channel'))
            )
        );
    }

    public function interactions(): array
    {
        return [
            'approve:{submission}' => fn (MessageComponent $interaction, string $submission) => $this->handleApproveSubmission($interaction, $submission),
            'reject:{submission}' => fn (MessageComponent $interaction, string $submission) => $this->handleRejectSubmission($interaction, $submission),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'goose-board' => $this->getGooseBoardAutocompleteCallback(),
        ];
    }

    public function getTeamService(): TeamService
    {
        return App::make(TeamService::class);
    }

    protected function getSubmissionService(): SubmissionService
    {
        return App::make(SubmissionService::class);
    }

    protected function handleApproveSubmission(MessageComponent $interaction, string $submissionId): void
    {
        $interaction->acknowledge();

        $submission = $this->getSubmissionService()->repository->find($submissionId);

        $this->getSubmissionService()->approve($submission);

        $this->notifySuccessfulAction(
            interaction: $interaction,
            submission: $submission,
            action: "approved"
        );
    }

    protected function handleRejectSubmission(MessageComponent $interaction, string $submissionId): void
    {
        $interaction->acknowledge();

        $submission = $this->getSubmissionService()->repository->find($submissionId);

        $this->getSubmissionService()->reject($submission);

        $this->notifySuccessfulAction(
            interaction: $interaction,
            submission: $submission,
            action: "rejected"
        );
    }

    private function notifySuccessfulAction(MessageComponent $interaction, Submission $submission, string $action): void
    {
        $interaction->deleteFollowUpMessage($interaction->message->id);

        $interaction->respondWithMessage(
            $this
                ->message("Successfully {$action} submission!")
                ->title("Successfully {$action} submission")
                ->imageUrl($submission->image_url)
                ->content("
                        :small_blue_diamond: Team: {$submission->team->name}
                        :small_blue_diamond: Submitter: {$submission->account->username}
                        :small_blue_diamond: Objective: {$submission->tile->name}
                        :small_blue_diamond: Code for submission: {$submission->verification_code}
                    ")
                ->success()
                ->send(Config::get('app.pet.discord-channel'))
        );
    }
}
