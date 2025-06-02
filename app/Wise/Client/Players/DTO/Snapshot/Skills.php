<?php

namespace App\Wise\Client\Players\DTO\Snapshot;

use App\Wise\Client\Players\DTO\Snapshot\Skills\Agility;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Attack;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Construction;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Cooking;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Crafting;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Defence;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Farming;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Firemaking;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Fishing;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Fletching;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Herblore;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Hitpoints;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Hunter;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Magic;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Mining;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Overall;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Prayer;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Ranged;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Runecrafting;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Slayer;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Smithing;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Strength;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Thieving;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Woodcutting;

readonly class Skills extends Basket
{
    public function __construct(
        public Overall $overall,
        public Attack $attack,
        public Defence $defence,
        public Strength $strength,
        public Hitpoints $hitpoints,
        public Ranged $ranged,
        public Prayer $prayer,
        public Magic $magic,
        public Cooking $cooking,
        public Woodcutting $woodcutting,
        public Fletching $fletching,
        public Fishing $fishing,
        public Firemaking $firemaking,
        public Crafting $crafting,
        public Smithing $smithing,
        public Mining $mining,
        public Herblore $herblore,
        public Agility $agility,
        public Thieving $thieving,
        public Slayer $slayer,
        public Farming $farming,
        public Runecrafting $runecrafting,
        public Hunter $hunter,
        public Construction $construction,
    ) {
    }
}
