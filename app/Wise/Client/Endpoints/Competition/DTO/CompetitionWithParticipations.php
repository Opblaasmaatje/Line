<?php

namespace App\Wise\Client\Endpoints\Competition\DTO;

use App\Models\Competition;
use App\Wise\Client\Endpoints\Competition\DTO\Competition\CompetitionObject;

class CompetitionWithParticipations
{
    protected Competition|null $model = null;

    public function __construct(
        public readonly CompetitionObject $competition,
        public readonly string $verificationCode,
    ){
    }

    protected function createModel(): Competition
    {
        $this->model = (new Competition)->fill([
            'wise_old_man_id' => $this->competition->id,
            'title' => $this->competition->title,
            'metric' => $this->competition->metric,
            'starts_at' => $this->competition->startsAt,
            'ends_at' => $this->competition->endsAt,
            'verification_code' => $this->verificationCode,
        ]);

        $this->model->save();

        return $this->model;
    }

    public function saveModel(): Competition
    {
        return $this->createModel();
    }
}
