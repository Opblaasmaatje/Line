<?php

namespace Tests\Unit\Wise;

use App\Models\Account;
use App\Wise\Client\OldMan;
use App\Wise\Client\Players\PlayerClient;
use Database\Factories\AccountFactory;
use Illuminate\Support\Facades\App;
use Tests\ApplicationTest;


/**
 * @coversNothing
 */
class WiseTest extends ApplicationTest
{
    public function test_it_works()
    {
        $this->assertTrue(true);
    }
}
