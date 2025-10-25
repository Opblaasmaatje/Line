<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Repository\TeamRepository;

use App\Models\Account;
use App\Modules\GooseBoards\Library\Repository\TeamRepository;
use Database\Factories\AccountFactory;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class FindTeamByAccountTest extends ApplicationCase
{
    #[Test]
    public function it_can_find_a_team_by_account_and_goose_board()
    {
        $team = TeamFactory::new()
            ->hasAttached(AccountFactory::new())
            ->for(GooseBoardFactory::new())
            ->create();

        $gooseBoard = $team->gooseBoard;

        /** @var Account $account */
        $account = $team->accounts->sole();

        $value = $this->subjectUnderTesting()->findTeamByAccount($account, $gooseBoard);

        $this->assertTrue($team->is($value));
    }

    #[Test]
    public function it_does_not_find_a_team_if_account_is_not_attached_to_goose_board()
    {
        $team = TeamFactory::new()
            ->hasAttached(AccountFactory::new())
            ->for(GooseBoardFactory::new())
            ->create();

        $gooseBoard = $team->gooseBoard;

        /** @var Account $account */
        $account = AccountFactory::new()->create();

        $value = $this->subjectUnderTesting()->findTeamByAccount($account, $gooseBoard);

        $this->assertFalse($team->is($value));
    }

    protected function subjectUnderTesting()
    {
        return $this->app->make(TeamRepository::class);
    }
}
