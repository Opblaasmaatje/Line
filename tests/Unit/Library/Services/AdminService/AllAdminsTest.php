<?php

namespace Tests\Unit\Library\Services\AdminService;

use App\Library\Services\AdminService;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class AllAdminsTest extends ApplicationCase
{
    #[Test]
    public function it_can_get_all_admins()
    {
        $admin = UserFactory::new()->asAdmin()->create();
        UserFactory::new()->notAdmin()->create();

        $this->assertCount(1, $this->subjectUnderTesting()->allAdmins());;
        $this->assertTrue($admin->is($this->subjectUnderTesting()->allAdmins()->sole()));
    }

    #[Test]
    public function it_also_looks_at_config_even_though_user_is_not_admin()
    {
        Config::set('discord.admins', ['some-id']);

        $admin = UserFactory::new()->notAdmin()->create([
            'discord_id' => 'some-id'
        ]);

        $this->assertCount(1, $this->subjectUnderTesting()->allAdmins());;
        $this->assertTrue($admin->is($this->subjectUnderTesting()->allAdmins()->sole()));
    }

    protected function subjectUnderTesting(): AdminService
    {
        return App::make(AdminService::class);
    }
}
