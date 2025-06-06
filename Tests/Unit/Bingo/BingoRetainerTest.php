<?php

namespace Tests\Unit\Bingo;

use App\Bingo\BingoRetainer;
use Database\Factories\BingoFactory;
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

        dd($retainer); ;
    }
}
