<?php

namespace Database\Factories;

use App\Bingo\Models\Bingo;
use Illuminate\Database\Eloquent\Factories\Factory;

class BingoFactory extends Factory
{
    protected $model = Bingo::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->bs,
        ];
    }
}
