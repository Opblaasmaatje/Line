<?php

namespace App\Modules\GooseBoards\Library\Repository;

use App\Modules\GooseBoards\Models\Queries\SubmissionQuery;
use App\Modules\GooseBoards\Models\Submission;

class SubmissionRepository
{
    protected SubmissionQuery $query;

    public function __construct()
    {
        $this->query = Submission::query();
    }

    public function find(string $submissionId): Submission
    {
        return $this->query->findOrFail($submissionId);
    }
}
