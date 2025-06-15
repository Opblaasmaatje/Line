<?php

namespace Tests\Unit\Bingo;

use App\Bingo\BingoException;
use App\Bingo\BingoHandler;
use App\Bingo\Models\AccountTeam;
use App\Bingo\Models\Bingo;
use App\Bingo\Models\Objective;
use App\Bingo\Models\Objectives\Submission;
use App\Bingo\Models\Team;
use App\Models\Account;
use Database\Factories\AccountFactory;
use Database\Factories\BingoFactory;
use Database\Factories\SubmissionFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class BingoHandlerTest extends ApplicationCase
{
    #[Test]
    public function a_team_can_be_created()
    {
        $bingo = BingoFactory::new()->create();

        $handler = BingoHandler::make($bingo);

        $handler->team('some-team-name');

        $this->assertDatabaseHas(Team::class, [
            'name' => 'some-team-name',
        ]);
    }


    #[Test]
    public function an_account_can_be_assign_to_a_team()
    {
        $accountModel = AccountFactory::new()->create([
            'user_id' => 1,
            'username' => 'name',
        ]);

        $bingo = BingoHandler::make(
            BingoFactory::new()->create()
        );

        $bingo
            ->team('some-team-name')
            ->assign($accountModel);


        /** @var Team $team */
        $team = Team::query()->sole();
        $this->assertCount(1, $team->accounts);

        /** @var Account $account */
        $account = $team->accounts->sole();
        $this->assertSame('name', $account->username);
    }

    #[Test]
    public function objectives_can_be_added_and_will_be_assigned_to_all_teams()
    {
        $bingo = BingoHandler::make(
            BingoFactory::new()->create()
        );

        $bingo->team('some-team-name');

        $submission = SubmissionFactory::new()
            ->create();

        $bingo->addObjective(
            (new Objective())
                ->task()
                ->associate($submission)
        );

        $team = $bingo->team('some-team-name');

        $this->assertDatabaseHas(Objective::class, [
            'task_type' => Submission::class,
        ]);
    }

    #[Test]
    public function bingo_can_be_instantiated_using_string()
    {
        BingoHandler::make('bingo-bango-bongo');

        $this->assertDatabaseHas(Bingo::class, [
            'name' => 'bingo-bango-bongo',
        ]);
    }

    #[Test]
    public function an_objective_cannot_be_assigned_when_there_are_no_teams()
    {
        $bingo = BingoFactory::new()->create();

        $sut = new BingoHandler($bingo);

        $submission = SubmissionFactory::new()
            ->create();

        $this->assertThrows(function () use ($sut, $submission) {
            $sut->addObjective(
                (new Objective())
                    ->task()
                    ->associate($submission)
            );
        }, BingoException::class);
    }

    #[Test]
    public function creating_a_team_when_there_are_already_other_teams_with_objective_copies_them_over_onto_the_other_teams(
    )
    {
        //
    }
}
