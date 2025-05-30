<?php

namespace App\SlashCommands;

use App\Models\Point;
use App\Models\User;
use Discord\Parts\Interactions\Command\Option;
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

        if (is_null($account)) {
            return $interaction->respondWithMessage(
                $this
                    ->message('You do not have an account attached.')
                    ->title('No associated account found!')
                    ->build()
            );
        }

        $chart = new QuickChart([
            'width' => 500,
            'height' => 300,
        ]);

        $chart->setConfig([
            'type' => 'pie',
            'data' => [
                'labels' => [
                    $account->points
                        ->filter(fn(Point $point) => $point->amount !== 0)
                        ->map(fn(Point $point) => $point->source)
                        ->toArray(),
                ],
                'datasets' => [
                    'data' => [
                        $account->points
                            ->filter(fn(Point $point) => $point->amount !== 0)
                            ->map(fn(Point $point) => $point->amount)
                            ->toArray(),
                    ],

                ],
            ],
        ]);

        return $interaction->respondWithMessage(
            $this->message()
                ->info()
                ->title('These are you total points!')
                ->field('points', $account->total_points)
                ->imageUrl($chart->getShortUrl())
                ->build()
        );
    }
}
