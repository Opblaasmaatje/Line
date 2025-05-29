<?php

namespace App\Wise\Client\Players\Objects\Snapshot;

use App\Wise\Client\Players\Objects\Snapshot\Skills\Agility;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Attack;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Construction;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Cooking;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Crafting;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Defense;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Farming;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Firemaking;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Fishing;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Fletching;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Herblore;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Hitpoints;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Hunter;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Magic;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Mining;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Overall;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Prayer;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Ranged;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Runecrafting;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Slayer;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Smithing;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Strength;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Thieving;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Woodcutting;

readonly class Skills
{
    public function __construct(
        public Overall $overall,
        public Attack $attack,
//        public Defense $defense,
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
        public  Herblore $herblore,
        public Agility $agility,
        public Thieving $thieving,
        public Slayer $slayer,
        public Farming $farming,
        public Runecrafting $runecrafting,
        public Hunter $hunter,
        public Construction $construction,
    ){
    }
}
