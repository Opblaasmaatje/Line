<?php

namespace Tests\Unit\Library\Repository\UserRepository;

use App\Library\Repository\UserRepository;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class SetUserByDiscordIdTest extends ApplicationCase
{
    #[Test]
    public function it_can_set_a_user_by_discord_id()
    {
        $account = $this->subjectUnderTesting()->setUserByDiscordId(
            'some-id'
        );

        $this->assertModelExists($account);
    }

    protected function subjectUnderTesting()
    {
        return $this->app->make(UserRepository::class);
    }
}
