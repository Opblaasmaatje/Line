<?php

namespace App\Modules\GooseBoards\Http\Controllers;

use App\Modules\GooseBoards\Http\Requests\GooseBoardRequest;
use App\Modules\GooseBoards\Http\Resources\GooseBoardResource;
use App\Modules\GooseBoards\Library\Service\GooseBoardService;
use Illuminate\Http\Request;
use Laracord\Http\Controllers\Controller;

class GooseBoardController extends Controller
{
    public function __construct(
        protected GooseBoardRequest $validator,
        protected GooseBoardService $service
    ) {
    }

    public function create(Request $request)
    {
        $validated = $this->validator->validate(
            $request->json()->all()
        );

        return new GooseBoardResource(
            $this->service->create($validated)
        );
    }
}
