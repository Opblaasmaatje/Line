<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Wise\Client\Enums\Metric;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->bs,
            'metric' => $this->faker->randomElement(
                Metric::cases()
            ),
            'wise_old_man_id' => $this->faker->unique()->uuid(),
            'starts_at' => $this->faker->dateTime(),
            'ends_at' => fn (array $attributes) => Carbon::make($attributes['starts_at'])->addDays(1),
            'verification_code' => $this->faker->uuid(),
        ];
    }
}
