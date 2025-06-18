<?php

namespace App\Wise\Client\Competition;

use App\Wise\Client\OldMan;
use App\Wise\Client\Players\DTO\PlayerSnapshot;
use App\Wise\Client\Players\WiseOldManException;
use Brick\JsonMapper\JsonMapper;
use Illuminate\Support\Carbon;

class CompetitionClient
{
    public function __construct(
        protected OldMan $oldMan,
        protected JsonMapper $mapper
    ){
    }

    public function createCompetition(string $competition)
    {
        $data = $this->oldMan->client()
            ->post("competitions", [
                'title' => $competition,
                'metric' => 'attack',
                'startsAt' => Carbon::now()->addMinute(),
                'endsAt' => Carbon::now()->addMinutes(3),
                'participants' => [
                    'sus_guy'
                ]
            ]);


        dd($data->body());

//        if($data->failed()){
//            throw new WiseOldManException("Could not find [{$username}]");
//        }
//
//        return $this->mapper->map($data->body(), PlayerSnapshot::class);
    }
}
