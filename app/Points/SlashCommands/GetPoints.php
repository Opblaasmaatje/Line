<?php

namespace App\Points\SlashCommands;

use App\Laracord\SlashCommands\SlashCommandWithAccount;
use App\Models\Account;
use App\Models\Point;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Collection;
use QuickChart;
use React\Promise\PromiseInterface;

class GetPoints extends SlashCommandWithAccount
{
    protected $name = 'points';

    protected $description = 'Check user stats';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    protected function action(Ping|ApplicationCommand $interaction, Account $account): PromiseInterface
    {
        return $interaction->respondWithMessage(
            $this->message()
                ->info()
                ->title('These are you total points!')
                ->field('Points', $account->total_points)
                ->field('URL', $account->url)
                ->content('Check some of your highest point contributions!')
                ->imageUrl($this->buildImage($account->points))
                ->build()
        );
    }

    public function buildImage(Collection $points): string
    {
        $points = $points
            ->sortBy(fn (Point $point) => $point->amount, descending: true)
            ->take(5);

        $quickChart = new QuickChart([
            'width' => 500,
            'height' => 300,
        ]);

        $quickChart->setConfig([
            'type' => 'bar',
            'data' => [
                'labels' => $points
                    ->map(fn (Point $point) => $point->title)
                    ->values()
                    ->toArray(),
                'datasets' => [
                    [
                        'label' => 'Points',
                        'data' => $points
                            ->map(fn (Point $point) => $point->amount)
                            ->values()
                            ->toArray(),

                    ],
                ],
            ],
        ]);

        return $quickChart->getShortUrl();
    }
}
