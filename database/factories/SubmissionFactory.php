<?php

namespace Database\Factories;

use App\Modules\GooseBoards\Models\Enums\Status;
use App\Modules\GooseBoards\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(Status::cases()),
            'image_url' => $this->faker->imageUrl(),
            'verification_code' => $this->faker->uuid(),
        ];
    }

    public function inProcess(): self
    {
        return $this->setStatus(Status::IN_PROCESS);
    }

    protected function setStatus(Status $status): self
    {
        return $this->set('status', $status);
    }
}
