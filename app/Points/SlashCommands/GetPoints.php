<?php

namespace App\Points\SlashCommands;

use App\Models\Point;
use App\Models\User;
use Discord\Parts\Interactions\Command\Option;
use Illuminate\Support\Collection;
use Laracord\Commands\SlashCommand;
use QuickChart;

class GetPoints extends SlashCommand
{
    protected $name = 'points';

    protected $description = 'Check user stats';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            (new option($this->discord()))
                ->setName('User')
                ->setDescription("Who's points do you want to know?")
                ->setType(Option::USER)
                ->setRequired(true),
        ];
    }

    public function handle($interaction)
    {
        $account = User::repository()->findAccount($this->option('user.value'));

        return $interaction->respondWithMessage(
            $this->message()
                ->info()
                ->title('These are you total points!')
                ->field('Points', $account->total_points)
                ->content("Check some of your highest point contributions!")
                ->imageUrl($this->buildImage($account->points))
                ->build()
        );
    }

    public function buildImage(Collection $points): string
    {
        $points = $points
            ->sortBy(fn(Point $point) => $point->amount, descending: true)
            ->take(5);

        $quickChart = new QuickChart([
            'width' => 500,
            'height' => 300,
        ]);

        $quickChart->setConfig([
            "type" => "bar",
            "data" => [
                "labels" => $points
                    ->map(fn(Point $point) => $point->title)
                    ->values()
                    ->toArray(),
                "datasets" => [
                    [
                        'label' => "Points",
                        "data" => $points
                            ->map(fn(Point $point) => $point->amount)
                            ->values()
                            ->toArray(),

                    ],
                ],
            ],
        ]);

        return $quickChart->getShortUrl();
    }
}
