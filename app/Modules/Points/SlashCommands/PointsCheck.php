<?php

namespace App\Modules\Points\SlashCommands;

use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\Points\Models\Point;
use App\Wise\SlashCommands\Parameters\HasAccount;
use Illuminate\Support\Collection;
use QuickChart;
use React\Promise\PromiseInterface;

class PointsCheck extends BaseSlashCommand
{
    use HasAccount;

    protected $name = 'points-check';

    protected $description = 'Check user points';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            $this->getAccountOption($this->discord()),
        ];
    }

    public function handle($interaction): PromiseInterface
    {
        return $interaction->respondWithMessage(
            $this->message()
                ->info()
                ->title('These are you total points!')
                ->field('Points', $this->account->total_points)
                ->field('URL', $this->account->url)
                ->content('Check some of your highest point contributions!')
                ->imageUrl($this->buildImage($this->account->points))
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
