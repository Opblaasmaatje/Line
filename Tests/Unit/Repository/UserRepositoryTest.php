<?php

namespace Tests\Unit\Repository;

use App\Repository\UserRepository;
use Database\Factories\AccountFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class UserRepositoryTest extends ApplicationCase
{
    #[Test]
    public function it_finds_account_based_on_id()
    {
        UserFactory::new()
            ->has(AccountFactory::new([
                'username' => 'this-should-be-found',
            ]))
            ->create([
                'discord_id' => 'some-discord-id',
            ]);

        $sut = (new UserRepository)->findAccount('some-discord-id');

        $this->assertEquals('this-should-be-found', $sut->username);
    }

    #[Test]
    public function it_throws_when_user_is_not_found()
    {
        $this->assertThrows(function (){
            (new UserRepository)->findAccount('this-id-does-not-exist');
        }, ModelNotFoundException::class);
    }
}
