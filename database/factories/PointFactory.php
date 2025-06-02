<?php

namespace Database\Factories;

use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointFactory extends Factory
{
    protected $model = Point::class;

    public function definition(): array
    {
        return [
            'source' => $this->faker->word,
            'amount' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
