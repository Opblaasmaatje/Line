<?php

namespace Database\Factories;

use App\Bingo\Models\Objectives\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
