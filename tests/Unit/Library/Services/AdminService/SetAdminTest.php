<?php

namespace Tests\Unit\Library\Services\AdminService;

use App\Library\Services\AdminService;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class SetAdminTest extends ApplicationCase
{

    public static function adminConfiguration(): array
    {
        return [
            'is already admin' => [true, false],
            'is not admin yet' => [false, true],
        ];
    }

    #[Test]
    #[DataProvider('adminConfiguration')]
    public function an_admin_can_be_set(bool $isAlreadyAdmin, bool $becameAdmin)
    {
        $user =  UserFactory::new()->set('is_admin', $isAlreadyAdmin)->create();

        $value = $this->subjectUnderTesting()->setAdmin(
            $user->discord_id,
            $becameAdmin,
        );

        $this->assertEquals($becameAdmin, $value->is_admin);
    }

    #[Test]
    public function it_creates_a_new_account_when_one_does_not_already_exist_for_interacting_user()
    {
        $user = $this->subjectUnderTesting()->setAdmin('goof ball', true);

        $this->assertModelExists($user);
    }


    protected function subjectUnderTesting(): AdminService
    {
        return App::make(AdminService::class);
    }
}
