<<<<<<< ours
<<<<<<< ours
<?php

namespace Database\Factories;

use App\Modules\GooseBoards\Models\GooseBoard;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GooseBoardFactory extends Factory
{
    protected $model = GooseBoard::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'starts_at' => Carbon::now()->addMonth()->toDateString(),
            'ends_at' => fn (array $attributes) => Carbon::make($attributes['starts_at'])->addMonth()->toDateString(),
            'image' => null,
        ];
    }
}
|||||||
=======
<?php

namespace Database\Factories;

use App\Modules\GooseBoards\Models\GooseBoard;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GooseBoardFactory extends Factory
{
    protected $model = GooseBoard::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'starts_at' => Carbon::now()->addMonth()->toDateString(),
            'ends_at' => fn (array $attributes) => Carbon::make($attributes['starts_at'])->addMonth()->toDateString(),
        ];
    }
}
>>>>>>> theirs
|||||||
=======
<?php

namespace Database\Factories;

use App\Modules\GooseBoards\Models\GooseBoard;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GooseBoardFactory extends Factory
{
    protected $model = GooseBoard::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'starts_at' => Carbon::now()->addMonth()->toDateString(),
            'ends_at' => fn (array $attributes) => Carbon::make($attributes['starts_at'])->addMonth()->toDateString(),
        ];
    }
}
>>>>>>> theirs
