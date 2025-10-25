<?php

namespace Tests\Unit\Modules\GooseBoards\Library\Services\TeamService;

use App\Models\Account;
use App\Modules\GooseBoards\Library\Services\TeamService;
use Database\Factories\AccountFactory;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\UserFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class RemoveTest extends ApplicationCase
{
    #[Test]
    public function it_removes_a_team_and_its_members()
    {
        /** @var Account $account */
        $account = AccountFactory::new()->has(UserFactory::new())->create();

        $team = TeamFactory::new()
            ->hasAttached($account)
            ->for(GooseBoardFactory::new())
            ->create();

        $this->subjectUnderTesting()->remove($team);
        $this->assertModelMissing($team);
        $this->assertEmpty($account->teams);
    }

    protected function subjectUnderTesting(): TeamService
    {
        return $this->app->make(TeamService::class);
    }
}
