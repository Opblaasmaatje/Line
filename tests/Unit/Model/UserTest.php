<?php

namespace Tests\Unit\Model;

use App\Library\Repository\UserRepository;
use App\Models\User;
use Database\Factories\UserFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class UserTest extends ApplicationCase
{
    #[Test]
    public function it_can_create_the_repository()
    {
        $this->assertInstanceOf(UserRepository::class, User::repository());
    }

    #[Test]
    public function it_can_highlight()
    {
        $user = UserFactory::new()->create([
            'discord_id' => 'some-id'
        ]);

        $this->assertEquals('<@some-id>', $user->highlight);
    }
}
