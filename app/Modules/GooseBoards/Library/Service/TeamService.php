<?php

namespace App\Modules\GooseBoards\Library\Service;

use App\Library\Services\AccountService;
use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Team;
use Illuminate\Support\Arr;

class TeamService
{
    public function __construct(
        protected AccountService $accountService
    ){
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
}
