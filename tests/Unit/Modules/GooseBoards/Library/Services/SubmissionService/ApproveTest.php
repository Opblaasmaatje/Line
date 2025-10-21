<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\SubmissionService;

use App\Modules\GooseBoards\Library\Services\SubmissionService;
use App\Modules\GooseBoards\Models\Enums\Status;
use Database\Factories\AccountFactory;
use Database\Factories\GooseBoardFactory;
use Database\Factories\SubmissionFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TileFactory;
use Database\Factories\UserFactory;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class ApproveTest extends ApplicationCase
{
    #[Test]
    public function it_can_be_approved_and_auto_rolls_the_code_for_the_team()
    {
        Str::createRandomStringsUsingSequence(['bar', 'bar']);

        $account = AccountFactory::new()->for(UserFactory::new())->create();
        $board = GooseBoardFactory::new()->create();

        $submission = SubmissionFactory::new()
            ->inProcess()
            ->for($account)
            ->for(TileFactory::new()->for($board))
            ->for(TeamFactory::new()->for($board)->hasAttached($account))
            ->create();

        $submission = $this->subjectUnderTesting()->approve($submission);

        $this->assertEquals(Status::APPROVED, $submission->status);
        $this->assertEquals('bar', $submission->team->verification_code);
    }

    protected function subjectUnderTesting(): SubmissionService
    {
        return $this->app->make(SubmissionService::class);
    }
}
