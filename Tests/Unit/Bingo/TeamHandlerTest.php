<?php

namespace Tests\Unit\Bingo;

use App\Bingo\Models\Objective;
use App\Bingo\Models\Objectives\Submission;
use App\Bingo\Models\Objectives\Threshold;
use App\Bingo\Models\Team;
use App\Bingo\TeamHandler;
use App\Models\Account;
use Database\Factories\AccountFactory;
use Database\Factories\SubmissionFactory;
use Database\Factories\TeamFactory;
use Database\Factories\ThresholdFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class TeamHandlerTest extends ApplicationCase
{
    #[Test]
    public function an_account_can_be_assigned()
    {
        /** @var Team $team */
        $team = TeamFactory::new()->create([
            'bingo_id' => 1
        ]);

        $handler = new TeamHandler($team);

        $handler->assign(
            AccountFactory::new()->create([
                'username' => 'some-username',
                'user_id' => 1,
            ])
        );

        $team->refresh();

        $this->assertCount(1, $team->accounts);

        /** @var Account $account */
        $account =  $team->accounts->sole();

        $this->assertSame('some-username', $account->username);
    }

    #[Test]
    public function an_objective_can_be_assigned_for_submission()
    {
        $sut = new TeamHandler(TeamFactory::new()->create(['bingo_id' => 1]));

        $submission = SubmissionFactory::new()->create([
            'name' => 'task-name'
        ]);

        $sut->addObjective(
            (new Objective())
                ->task()
                ->associate($submission)
        );

        $team = $sut->getTeam();

        $this->assertCount(1, $team->objectives);

        /** @var Objective $objective */
        $objective = $team->objectives->sole();
        $this->assertSame('task-name', $objective->task->name);
        $this->assertSame(Submission::class, $objective->task_type);
    }

    #[Test]
    public function an_objective_can_be_assigned_for_threshold()
    {
        $sut = new TeamHandler(TeamFactory::new()->create(['bingo_id' => 1]));

        $submission= ThresholdFactory::new()->create([
            'name' => 'task-name'
        ]);

        $sut->addObjective(
            (new Objective())
                ->task()
                ->associate($submission)
        );

        $team = $sut->getTeam();

        $this->assertCount(1, $team->objectives);

        /** @var Objective $objective */
        $objective = $team->objectives->sole();
        $this->assertSame('task-name', $objective->task->name);
        $this->assertSame(Threshold::class, $objective->task_type);
    }

}
