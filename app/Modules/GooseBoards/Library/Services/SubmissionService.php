<?php

namespace App\Modules\GooseBoards\Library\Services;

use App\Modules\GooseBoards\Models\Enums\Status;
use App\Modules\GooseBoards\Models\Submission;

class SubmissionService
{
    public function __construct(
        protected TeamService $teamService,
    ) {
    }

    public function approve(Submission $submission): Submission
    {
        $submission->fill([
            'status' => Status::APPROVED,
        ])->save();

        $this->teamService->nextTile($submission->team);

        return $submission;
    }

    public function reject(Submission $submission): Submission
    {
        $submission->fill([
            'status' => Status::REJECTED,
        ])->save();

        return $submission;
    }
}
