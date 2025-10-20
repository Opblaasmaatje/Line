<?php

namespace Database\Seeders;

use App\Modules\GooseBoards\Models\Team;
use Database\Factories\AccountFactory;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TileFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use LogicException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if(! Config::has('discord.admin-developer.discord-id') || ! Config::has('discord.admin-developer.wise-old-man-id')){
            throw new LogicException('Cannot seed database without admin developer!');
        }

        $user = UserFactory::new()
            ->has(AccountFactory::new(
                [
                    'username' => 'sus guy',
                    'external_id' => Config::get('discord.admin-developer.wise-old-man-id')
                ]))
            ->asAdmin()
            ->create([
                'discord_id' => Config::get('discord.admin-developer.discord-id'),
            ]);


        $token = $user->createToken('token', ['http'])->plainTextToken;

        $this->command->info("HTTP TOKEN: " . $token);

        $board = GooseBoardFactory::new()
            ->has(TeamFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->has(TileFactory::new())
            ->create([
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addMonth(),
            ]);

        /** @var Team $team */
        $team = $board->teams->sole();

        $team->accounts()->attach($user->account);
    }
}
