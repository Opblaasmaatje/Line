<?php

namespace Database\Factories;

use App\Modules\GooseBoards\Models\Tile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TileFactory extends Factory
{
    protected $model = Tile::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
