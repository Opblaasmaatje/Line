<?php

namespace App\Modules\GooseBoards\Library\Services;

use App\Library\Services\AccountService;
use App\Models\Account;
use App\Modules\GooseBoards\Library\Repository\TeamRepository;
use App\Modules\GooseBoards\Models\Enums\Status;
use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Submission;
use App\Modules\GooseBoards\Models\Team;
use App\Modules\GooseBoards\Models\Tile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TeamService
{
    public function __construct(
        public readonly TeamRepository $repository,
        protected AccountService $accountService,
    ) {
    }

    public function create(GooseBoard $board, array $data): Team
    {
        /** @var Team $team */
        $team = $board->teams()->create(
            Arr::only($data, (new Team)->getFillable())
        );

        foreach ($data['accounts'] as $account) {
            $account = $this->accountService->accountRepository->findByUsername($account);

            $team->accounts()->attach($account);
        }

        return $team;
    }

    public function submit(Account $account, Team $team, Tile $tile, string $imageUrl): Submission
    {
        /** @var Submission $submission */
        $submission = $team->submissions()->make([
            'status' => Status::IN_PROCESS,
            'image_url' => $imageUrl,
        ]);

        $submission->account()->associate($account);
        $submission->tile()->associate($tile);
        $submission->save();

        return $submission;
    }

    public function nextTile(Team $team): Team
    {
        $team->fill([
            'code' => Str::random(6),
            'position' => $team->position + 1, //TODO figure out how to do this better
        ])
            ->save();

        return $team;
    }
}
