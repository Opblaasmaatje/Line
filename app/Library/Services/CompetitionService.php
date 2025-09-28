<?php

namespace App\Wise\Services;

use App\Wise\Client\Endpoints\Competition\CompetitionEndpoint;
use App\Wise\Client\Enums\Metric;

class CompetitionService
{
    public function __construct(
        protected CompetitionEndpoint $endpoint
    ){
    }

    public function create(string $competition, Metric $metric, )
    {

    }
}
