<?php

namespace App\Modules\Points\SlashCommands;

use App\Models\Account;
use Illuminate\Support\Collection;
use Laracord\Commands\SlashCommand;
use QuickChart;

class PointsLeaderboard extends SlashCommand
{
    protected $name = 'points-leaderboard';

    protected $description = 'Get the points leaderboard!';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function handle($interaction)
    {
        $accounts = Account::query()
            ->with('points')
            ->whereHas('points')
            ->get()
            ->sortBy(fn (Account $account) => $account->total_points)
            ->take(5)
            ->reverse()
            ->values();

        return $interaction->respondWithMessage(
            $this->message()
                ->info()
                ->title('The leaderboard')
                ->content('Check out the leaderboard!')
                ->imageUrl($this->buildImage($accounts))
                ->build()
        );
    }

    public function buildImage(Collection $accounts): string
    {
        $quickChart = new QuickChart([
            'width' => 500,
            'height' => 300,
        ]);

        $quickChart->setConfig([
            'type' => 'bar',
            'data' => [
                'labels' => $accounts
                    ->map(fn (Account $account) => $account->username)
                    ->values()
                    ->toArray(),
                'datasets' => [
                    [
                        'label' => 'Points',
                        'data' => $accounts
                            ->map(fn (Account $account) => $account->total_points)
                            ->values()
                            ->toArray(),

                    ],
                ],
            ],
        ]);

        return $quickChart->getShortUrl();
    }
}
