<?php

namespace Tests\Unit\Bingo;

use App\Bingo\BingoRetainer;
use App\Models\Account;
use Database\Factories\BingoFactory;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class BingoRetainerTest extends ApplicationCase
{
    #[Test]
    public function it_works()
    {

        $bingo = BingoFactory::new()->create();

        $retainer = BingoRetainer::make($bingo);

        $retainer->createTeam();


        dd($retainer);;
    }
}
