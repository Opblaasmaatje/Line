<?php

namespace Tests\Unit\Modules\GooseBoards\Controllers\GooseBoardTest;

use App\Models\Account;
use App\Modules\GooseBoards\Http\Controllers\GooseBoardController;
use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Pivot\AccountTeam;
use App\Modules\GooseBoards\Models\Team;
use App\Modules\GooseBoards\Models\Tile;
use Database\Factories\AccountFactory;
use Database\Factories\GooseBoardFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TileFactory;
use Database\Factories\UserFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class CreateTest extends ApplicationCase
{
    use MatchesSnapshots;
    use HasFixtureAccess;

    #[Test]
    public function it_creates_a_goose_board()
    {
        Storage::fake('public');
        GooseBoard::query()->truncate();

        Http::fake([
            '*' => Http::response(json_decode($this->getFromFixture('create_competition.json'), true), 200),
        ]);

        Carbon::setTestNow('2023-01-01');

        $request = $this->getRequest(
            $this->requestData()
        );

        $response = $this->subjectUnderTesting()->create($request);

        $responseData = $response->response()->getData(true);

        $this->assertMatchesJsonSnapshot($responseData);
        $this->assertDatabaseCount(Account::class, 2);
        $this->assertDatabaseCount(GooseBoard::class, 1);
        $this->assertDatabaseCount(Team::class, 1);
        $this->assertDatabaseCount(Tile::class, 10);
        $this->assertDatabaseCount(AccountTeam::class, 2);
    }

    protected function requestData(): array
    {
        $accounts = AccountFactory::new()
            ->for(UserFactory::new())
            ->forEachSequence(
                [
                    'username' => 'name',
                ],
                [
                    'username' => 'other name',
                ],
            )
            ->count(2)
            ->create();

        $team = [
            ...TeamFactory::new()->raw([
                'name' => 'team name',
            ]),
            'accounts' => $accounts->map(fn (Account $account) => $account->username)->toArray(),
        ];

        return [
            'goose_board' => GooseBoardFactory::new()->raw([
                'name' => 'some-name',
                'description' => 'some-description',
                'starts_at' => '2023-02-01',
                'ends_at' => '2023-03-02',
            ]),
            'tiles' => TileFactory::new()
                ->withoutImage()
                ->forEachSequence(
                    [
                        'name' => 'A',
                    ],
                    [
                        'name' => 'B',
                    ],
                    [
                        'name' => 'C',
                    ],
                    [
                        'name' => 'D',
                    ],
                    [
                        'name' => 'E',
                    ],
                    [
                        'name' => 'F',
                    ],
                    [
                        'name' => 'G',
                    ],
                    [
                        'name' => 'H',
                    ],
                    [
                        'name' => 'I',
                    ],
                    [
                        'name' => 'J',
                    ],
                )->raw([
                    'description' => 'some-description',
                ]),
            'teams' => [$team],
        ];
    }

    protected function subjectUnderTesting(): GooseBoardController
    {
        return App::make(GooseBoardController::class);
    }
}
