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
            'image_url' => $this->faker->randomElement($this->getImageSelection()),
        ];
    }

    public function withoutGooseBoard(): self
    {
        return $this->set('goose_board_id', 1);
    }

    public function withoutImage(): self
    {
        return $this->set('image_url', null);
    }

    protected function getImageSelection(): array
    {
        return [
            'https://cdn.discordapp.com/attachments/1378137676997328927/1429929502045376532/image_2.jpg?ex=68f7ed20&is=68f69ba0&hm=f3e4274a86fe5e6e5c2475d2557e91f212abcdb935f779a52a2b6027feeb7a60&',
            'https://cdn.discordapp.com/attachments/1378137676997328927/1429929526347038760/image_3.jpg?ex=68f7ed25&is=68f69ba5&hm=8dd069cd323bf915fe6202c37f377dab1d268e9c0a4bc08425cfdd53dc6972cb&',
            'https://cdn.discordapp.com/attachments/1378137676997328927/1429929549885472778/image.jpg?ex=68f7ed2b&is=68f69bab&hm=e2967848262484ee69a14caeea86f6baef1f49ede457d307b89ae6adc812f0be&',
        ];
    }
}
