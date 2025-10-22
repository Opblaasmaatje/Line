<?php

namespace App\Modules\GooseBoards\SlashCommands;

use AllowDynamicProperties;
use App\Laracord\Button;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\GooseBoards\Library\Services\SubmissionService;
use App\Modules\GooseBoards\Library\Services\TeamService;
use App\Modules\GooseBoards\Models\Submission;
use App\Modules\GooseBoards\SlashCommands\Parameters\HasGooseBoard;
use App\Wise\SlashCommands\Parameters\HasImage;
use App\Wise\SlashCommands\Parameters\HasYourself;
use Discord\Parts\Interactions\Interaction;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Laracord\Discord\Message;
use React\Promise\PromiseInterface;

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
            $this->getImageOption($this->discord()),
        ];
    }

    /**
     * @param Interaction $interaction
     */
    public function handle($interaction): PromiseInterface
    {
        $team = $this->getTeamService()->repository->findTeam(
            $this->yourself,
            $this->gooseBoard
        );

        if (! $team) {
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

        $message = $this
            ->message('An admin will check it shortly™')
            ->title(':100: You submitted a tile for your team! :100:')
            ->imageUrl($submission->image_url)
            ->success();

        $message = $this->buildFields($message, $submission);

        return $interaction->respondWithMessage(
            $message->build()
        )
            ->then(fn () => $this->handleReviewSubmission($interaction, $submission),
        );
    }

    public function autocomplete(): array
    {
        return [
            'goose-board' => $this->getGooseBoardAutocompleteCallback(),
        ];
    }

    protected function handleApproveSubmission($interaction, string $submissionId): void
    {
        $interaction->acknowledge();

        $submission = $this->getSubmissionService()->repository->find($submissionId);

        $this->getSubmissionService()->approve($submission);

        $this->interactionSuccessful(
            interaction: $interaction,
            submission: $submission,
            action: 'approved'
        );
    }

    public function interactions(): array
    {
        return [
            'approve:{submission}' => fn ($interaction, string $submission) => $this->handleApproveSubmission($interaction, $submission),
            'reject:{submission}' => fn ($interaction, string $submission) => $this->handleRejectSubmission($interaction, $submission),
        ];
    }

    protected function handleReviewSubmission(Interaction $interaction, Submission $submission): \React\Promise\PromiseInterface
    {
        $message = $this
            ->message("Please review the following submission.")
            ->title("Please review the following submission.")
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
            ->info();

        $message = $this->buildFields($message, $submission);

        return $interaction->respondWithMessage(
        /* @phpstan-ignore-next-line */
            $message->send(Config::get('app.pet.discord-channel'))
        );
    }

    protected function handleRejectSubmission(Interaction $interaction, string $submissionId): void
    {
        $interaction->acknowledge();

        $submission = $this->getSubmissionService()->repository->find($submissionId);

        $this->getSubmissionService()->reject($submission);

        $this->interactionSuccessful(
            interaction: $interaction,
            submission: $submission,
            action: 'rejected'
        );
    }

    protected function interactionSuccessful(Interaction $interaction, Submission $submission, string $action): void
    {
        $interaction->deleteFollowUpMessage($interaction->message->id);

        $message = $this
            ->message("Successfully {$action} submission!")
            ->title("Successfully {$action} submission")
            ->imageUrl($submission->image_url)
            ->success();

        $message = $this->buildFields($message, $submission);

        $interaction->respondWithMessage(
            /* @phpstan-ignore-next-line */
            $message->send(Config::get('app.pet.discord-channel'))
        );
    }

    protected function buildFields(Message $message, Submission $submission): Message
    {
        $message->field(":small_blue_diamond: Team: {$submission->team->name}", '', false);
        $message->field(":small_blue_diamond: Submitter: {$submission->account->username}", '', false);
        $message->field(":small_blue_diamond: Objective: {$submission->tile->name}", '', false);
        $message->field(":small_blue_diamond: Code: {$submission->team->verification_code}", '', false);
        $message->field(":small_blue_diamond: Position: ({$submission->team->position}/{$this->gooseBoard->tiles->count()})", '');

        return $message;
    }

    protected function getSubmissionService(): SubmissionService
    {
        return App::make(SubmissionService::class);
    }

    public function getTeamService(): TeamService
    {
        return App::make(TeamService::class);
    }
}
