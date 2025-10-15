<?php

namespace Database\Factories;

use App\Models\Snapshot;
use Illuminate\Database\Eloquent\Factories\Factory;

class SnapshotFactory extends Factory
{
    protected $model = Snapshot::class;

    public function definition(): array
    {
        return [
            //
        ];
    }


    public function withFixture(string $filename): self
    {
        return $this->set('raw_details', json_decode($this->getFromFixture($filename)));
    }


    protected function getFromFixture(string $filename): false|string
    {
        return file_get_contents(base_path("tests/fixtures/$filename"));
    }
}
