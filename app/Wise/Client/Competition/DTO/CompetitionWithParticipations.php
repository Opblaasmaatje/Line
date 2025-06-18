<?php

namespace App\Wise\Client\Competition\DTO;

use App\Wise\Client\Competition\DTO\Competition\CompetitionObject;

readonly class CompetitionWithParticipations
{
    public function __construct(
        public CompetitionObject $competition,
        public string $verificationCode,

    ){
    }
}
