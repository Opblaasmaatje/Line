<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'discord_id' => $this->faker->unique()->uuid(),
            'is_admin' => $this->faker->boolean(),
        ];
    }

    public function asAdmin(): self
    {
        return $this->set('is_admin', true);
    }
}
