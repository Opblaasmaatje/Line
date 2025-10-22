<?php

namespace Database\Factories;

use App\Modules\GooseBoards\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'position' => 1,
            'verification_code' => $this->faker->word,
            'channel_id' => $this->faker->uuid(),
        ];
    }

    public function position(int $position): self
    {
        return $this->set('position', $position);
    }
}
