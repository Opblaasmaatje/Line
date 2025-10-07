<?php

namespace App\Wise\Client\Endpoints\Competition\DTO;

use App\Wise\Client\Endpoints\Players\DTO\Player;
use Illuminate\Contracts\Support\Arrayable;

readonly class ParticipantHistory
{
    /**
     * @param History[] $history
     */
    public function __construct(
         public Player $player,
         public array $history
    ) {
    }
}
