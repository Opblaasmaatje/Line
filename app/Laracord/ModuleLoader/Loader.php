<?php

namespace App\Laracord\ModuleLoader;

use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardAddTeamMember;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardAddTile;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardCreate;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardCreateTeam;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardRefreshBoard;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardRemoveTeam;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardRemoveTeamMember;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardRemoveTile;
use App\Modules\GooseBoards\SlashCommands\Admin\GooseBoardSetTeamPosition;
use App\Modules\GooseBoards\SlashCommands\GooseBoardCheck;
use App\Modules\GooseBoards\SlashCommands\GooseBoardLeaderboard;
use App\Modules\GooseBoards\SlashCommands\GooseBoardObjective;
use App\Modules\GooseBoards\SlashCommands\GooseBoardTileSubmit;
use App\Modules\Pets\SlashCommands\CheckPets;
use App\Modules\Pets\SlashCommands\ProofPet;
use App\Modules\Pets\SlashCommands\SubmitPet;
use App\Modules\Points\SlashCommands\Admin\PointsGive;
use App\Modules\Points\SlashCommands\PointsCheck;
use App\Modules\Points\SlashCommands\PointsLeaderboard;
use App\SlashCommands\Admin\CompetitionCreate;
use App\SlashCommands\Admin\CompetitionDelete;
use App\SlashCommands\Admin\SetAccount;
use App\SlashCommands\Admin\SetAdmin;
use App\SlashCommands\CompetitionLeaderboard;
use App\SlashCommands\GetRecords;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class Loader
{
    protected array $configuration;

    protected array $activeModules;

    public function __construct()
    {
        $this->configuration = [
            'core' => [
                CompetitionLeaderboard::class,
                GetRecords::class,
                SetAdmin::class,
                SetAccount::class,
                CompetitionDelete::class,
                CompetitionCreate::class,
            ],
            'pets' => [
                CheckPets::class,
                ProofPet::class,
                SubmitPet::class,
            ],
            'points' => [
                PointsCheck::class,
                PointsLeaderboard::class,
                PointsGive::class,
            ],
            'goose-board' => [
                GooseBoardCheck::class,
                GooseBoardLeaderboard::class,
                GooseBoardObjective::class,
                GooseBoardTileSubmit::class,
                GooseBoardAddTeamMember::class,
                GooseBoardAddTile::class,
                GooseBoardCreate::class,
                GooseBoardCreateTeam::class,
                GooseBoardRefreshBoard::class,
                GooseBoardRefreshBoard::class,
                GooseBoardRemoveTeam::class,
                GooseBoardRemoveTeamMember::class,
                GooseBoardRemoveTile::class,
                GooseBoardSetTeamPosition::class,
            ],
        ];

        $this->activeModules = Config::get('app.modules.active');
    }

    public function getActive(): Collection
    {
        return collect($this->configuration)->filter(function (array $commands, string $key) {
            return in_array($key, $this->activeModules);
        });
    }

    public function getActiveCommands(): Collection
    {
        return $this->getActive()->flatten();
    }
}
