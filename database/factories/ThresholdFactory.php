<?php

namespace Database\Factories;

use App\Bingo\Models\Objectives\Threshold;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThresholdFactory extends Factory
{
    protected $model = Threshold::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'amount' => $this->faker->randomFloat(2, 10),
        ];
    }
}
