<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\TeamService;

use App\Models\Account;
use App\Modules\GooseBoards\Library\Services\TeamService;
use App\Modules\GooseBoards\Models\Enums\Status;
use App\Modules\GooseBoards\Models\Submission;
use App\Modules\GooseBoards\Models\Team;
use App\Modules\GooseBoards\Models\Tile;
use Database\Factories\AccountFactory;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TileFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class SubmitTest extends ApplicationCase
{
    #[Test]
    public function it_creates_submission_associating_relations_eloquently(): void
    {
        $board = GooseBoardFactory::new()
            ->has(TeamFactory::new()->hasAttached(AccountFactory::new()))
            ->has(TileFactory::new())
            ->create();

        /** @var Team $team */
        $team = $board->teams->sole();

        /** @var Tile $tile */
        $tile = $board->tiles->sole();

        /** @var Account $account */
        $account = $team->accounts->sole();

        $service = $this->subjectUnderTesting();

        $assertSubmissionVerificationCode = $team->verification_code;

        $submission = $service->submit(
            account: $account,
            team: $team,
            tile: $tile,
            imageUrl: 'https://example.com/image.png',
        );

        $this->assertInstanceOf(Submission::class, $submission);
        $this->assertTrue($submission->exists);
        $this->assertEquals(Status::IN_PROCESS, $submission->status);
        $this->assertEquals($assertSubmissionVerificationCode, $submission->verification_code);

        $this->assertSame($team->getKey(), $submission->team_id);
        $this->assertSame($account->getKey(), $submission->account_id);
        $this->assertSame($tile->getKey(), $submission->tile_id);
        $this->assertSame('https://example.com/image.png', $submission->image_url);

        $this->assertTrue($submission->relationLoaded('team') === false || $submission->team->is($team));
        $this->assertTrue($submission->relationLoaded('account') === false || $submission->account->is($account));
        $this->assertTrue($submission->relationLoaded('tile') === false || $submission->tile->is($tile));
    }

    protected function subjectUnderTesting()
    {
        return $this->app->make(TeamService::class);
    }
}
