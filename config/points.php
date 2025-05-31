<?php

use App\Helpers\OldSchoolRuneScape;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\AbyssalSire;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\AlchemicalHydra;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Amoxliatl;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Araxxor;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Artio;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Barrows;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Bryophyta;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Callisto;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Calvarion;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Cerberus;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\ChambersOfXeric;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\ChaosElemental;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\ChaosFanatic;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\CommanderZilyana;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\CorporealBeast;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\CrazyArchaeologist;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\DagannothPrime;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\DagannothRex;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\DagannothSupreme;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\DerangedArchaeologist;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\DukeSucellus;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\GeneralGraardor;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\GiantMole;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\GrotesqueGuardians;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Hespori;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\KalphiteQueen;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\KingBlackDragon;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Kraken;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Kreearra;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\KrilTsutsaroth;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Mimic;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Moons;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Nex;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Nightmare;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Obor;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\PhantomMuspah;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\PhosanisNightmare;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Sarachnis;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Scorpia;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Scurrius;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Skotizo;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\SolHeredit;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheatreOfBlood;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheatreOfBloodHardMode;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheCorruptedGauntlet;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheGauntlet;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheHueycoatl;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheLeviathan;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\ThermonuclearSmokeDevil;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheRoyalTitans;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TheWhisperer;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TombsOfAmascut;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TombsOfAmascutExpert;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TzkalZuk;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TztokJad;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Vardorvis;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Venenatis;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Vetion;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Vorkath;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Yama;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Zulrah;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Overall;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Skill;

return [
    'bosses' => [
        AbyssalSire::class => [
            'per' => 1,
            'give' => 0.08,
        ],
        AlchemicalHydra::class => [
            'per' => 1,
            'give' => 0.1,
        ],
        Amoxliatl::class => [
            'per' => 1,
            'give' => 0.03,
        ],
        Araxxor::class => [
            'per' => 1,
            'give' => 0.08,
        ],
        Artio::class => [
            'per' => 1,
            'give' => 0.4,
        ],
        Barrows::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        Bryophyta::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        Callisto::class => [
            'per' => 1,
            'give' => 0.04,
        ],
        Calvarion::class => [
            'per' => 1,
            'give' => 0.04,
        ],
        Cerberus::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        ChambersOfXeric::class => [
            'per' => 1,
            'give' => 1.5,
        ],
        //TODO check Chambers of xeric CM
        ChaosElemental::class => [
            'per' => 1,
            'give' => 0.03,
        ],
        ChaosFanatic::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        CommanderZilyana::class => [
            'per' => 3,
            'give' => 1,
        ],
        CorporealBeast::class => [
            'per' => 1,
            'give' => 0.35,
        ],
        CrazyArchaeologist::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        DagannothPrime::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        DagannothRex::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        DagannothSupreme::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        DerangedArchaeologist::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        DukeSucellus::class => [
            'per' => 1,
            'give' => 0.1,
        ],
        GeneralGraardor::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        GiantMole::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        GrotesqueGuardians::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        Hespori::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        KalphiteQueen::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        KingBlackDragon::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        Kraken::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        Kreearra::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        KrilTsutsaroth::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        Mimic::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        Nex::class => [
            'per' => 1,
            'give' => 0.15,
        ],
        Obor::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        Moons::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        PhantomMuspah::class => [
            'per' => 1,
            'give' => 0.1,
        ],
        TheRoyalTitans::class => [
            'per' => 1,
            'give' => 0.04,
        ],
        Sarachnis::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        Scorpia::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        Scurrius::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        Skotizo::class => [
            'per' => 1,
            'give' => 0.05,
        ],
        SolHeredit::class => [
            'per' => 1,
            'give' => 2.5,
        ],
        TheGauntlet::class => [
            'per' => 1,
            'give' => 0.2,
        ],
        TheCorruptedGauntlet::class => [
            'per' => 1,
            'give' => 0.375,
        ],
        TheHueycoatl::class => [
            'per' => 1,
            'give' => 0.125,
        ],
        TheLeviathan::class => [
            'per' => 1,
            'give' => 0.01,
        ],
        PhosanisNightmare::class => [
            'per' => 1,
            'give' => 0.6,
        ],
        Nightmare::class => [
            'per' => 1,
            'give' => 0.15,
        ],
        TheWhisperer::class => [
            'per' => 1,
            'give' => 0.125,
        ],
        TheatreOfBlood::class => [
            'per' => 1,
            'give' => 2,
        ],
        TheatreOfBloodHardMode::class => [
            'per' => 1,
            'give' => 3,
        ],
        ThermonuclearSmokeDevil::class => [
            'per' => 1,
            'give' => 0.025,
        ],
        TombsOfAmascut::class => [
            'per' => 1,
            'give' => 1,
        ],
        TombsOfAmascutExpert::class => [
            'per' => 1,
            'give' => 1.5,
        ],
        TzkalZuk::class => [
            'per' => 1,
            'give' => 4,
        ],
        TztokJad::class => [
            'per' => 1,
            'give' => 1,
        ],
        Vardorvis::class => [
            'per' => 1,
            'give' => 0.1,
        ],
        Venenatis::class => [
            'per' => 1,
            'give' => 0.04,
        ],
        Vetion::class => [
            'per' => 1,
            'give' => 0.04,
        ],
        Vorkath::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        Yama::class => [
            'per' => 1,
            'give' => 0.2,
        ],
        Zulrah::class => [
            'per' => 1,
            'give' => 0.075,
        ],
        Boss::class => [
            'per' => 1,
            'give' => 0.01,
        ],
    ],
    'skills' => [
        Overall::class => [
            'per' => 0,
            'give' => 0,
        ],
        Skill::class => [
            'per' => OldSchoolRuneScape::LVL99XP,
            'give' => 10.0,
        ],
    ],
];
