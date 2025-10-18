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
            'name' => $this->faker->unique()->randomElement(PetName::cases()),
            'status' => $this->faker->randomElement(Status::cases()),
            'image_url' => $this->faker->imageUrl(),
            'account_id' => $this->faker->unique()->numberBetween(),
        ];
    }

    public function setStatus(Status $status): self
    {
        return $this->set('status', $status);
    }

    public function approved(): self
    {
        return $this->setStatus(Status::APPROVED);
    }

    public function rejected(): self
    {
        return $this->setStatus(Status::REJECTED);
    }

    public function inProcess(): self
    {
        return $this->setStatus(Status::IN_PROCESS);
    }
}
