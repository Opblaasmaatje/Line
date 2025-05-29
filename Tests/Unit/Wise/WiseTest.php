<?php

namespace Tests\Unit\Wise;

use App\Models\Account;
use App\Wise\Client\OldMan;
use App\Wise\Client\Players\PlayerClient;
use Database\Factories\AccountFactory;
use Illuminate\Support\Facades\App;
use Tests\ApplicationTest;

class WiseTest extends ApplicationTest
{
    public function test_it_works()
    {
        /** @var Account $account */
        $account = AccountFactory::new([
            'username' => 'sus guy',
            'user_id' =>1,
        ])
            ->create();


        dd($account->details);
    }
}
