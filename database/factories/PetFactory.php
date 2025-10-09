<?php

namespace Database\Factories;

use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use App\Modules\Pets\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(PetName::cases()),
            'status' => $this->faker->randomElement(Status::cases()),
        ];
    }
}
