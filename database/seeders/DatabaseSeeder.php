<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\GooseBoards\Models\GooseBoard;
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

        $user = $this->seedDevAccount();

        if(! Config::has('discord.admin-developer.team-channel')){
            throw new LogicException('Cannot seed gooseboard without team channel!');
        }

        $this->seedGooseBoard($user);
    }

    protected function seedDevAccount(): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|array|\App\Models\User|\LaravelIdea\Helper\App\Models\_IH_User_C
    {
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

        return $user;
    }

    protected function seedGooseBoard(User $user): GooseBoard
    {
        $board = GooseBoardFactory::new()
            ->has(TeamFactory::new(['channel_id' => Config::get('discord.admin-developer.team-channel')]))
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

        return $board;
    }
}
