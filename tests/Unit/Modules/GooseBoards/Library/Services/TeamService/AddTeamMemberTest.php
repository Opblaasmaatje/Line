<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\TeamService;

use App\Models\Account;
use App\Modules\GooseBoards\Library\Services\TeamService;
use App\Modules\GooseBoards\Models\Team;
use Database\Factories\AccountFactory;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\UserFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class AddTeamMemberTest extends ApplicationCase
{
    #[Test]
    public function it_adds_a_account_to_a_team()
    {
        /** @var Account $account */
        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->create();

        $team = TeamFactory::new()
            ->for(GooseBoardFactory::new())
            ->create();

        $this->subjectUnderTesting()->addTeamMember($account, $team);

        /** @var Team $attachedTeam */
        $attachedTeam = $account->teams->sole();

        $this->assertTrue($team->is($attachedTeam));
    }

    #[Test]
    public function it_cannot_add_a_team_member_when_it_is_already_assigned_to_a_different_team()
    {
        /** @var Account $account */
        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->create();

        $team = TeamFactory::new()
            ->for(GooseBoardFactory::new())
            ->create();

        $this->assertTrue($this->subjectUnderTesting()->addTeamMember($account, $team));

        $this->assertFalse($this->subjectUnderTesting()->addTeamMember($account, $team));
    }

    protected function subjectUnderTesting(): TeamService
    {
        return $this->app->make(TeamService::class);
    }
}
