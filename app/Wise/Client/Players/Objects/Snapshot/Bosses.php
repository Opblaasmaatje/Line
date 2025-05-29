<?php

namespace App\Wise\Client\Players\Objects\Snapshot;

use App\Wise\Client\Players\Objects\Snapshot\Bosses\AbyssalSire;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\AlchemicalHydra;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Amoxliatl;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Araxxor;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Artio;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Barrows;
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

readonly class Bosses
{
    public function __construct(
        public AbyssalSire $abyssal_sire,
        public AlchemicalHydra $alchemical_hydra,
        public Amoxliatl $amoxliatl,
        public Araxxor $araxxor,
        public Artio $artio,
        public Barrows $barrows_chests,
        public Bryophyta $bryophyta,
        public Callisto $callisto,
        public Calvarion $calvarion,
        public Cerberus $cerberus,
        public ChambersOfXeric $chambers_of_xeric,
        public ChaosElemental $chaos_elemental,
        public ChaosFanatic $chaos_fanatic,
        public CommanderZilyana $commander_zilyana,
        public CorporealBeast $corporeal_beast,
        public CrazyArchaeologist $crazy_archaeologist,
        public DagannothPrime $dagannoth_prime,
        public DagannothRex $dagannoth_rex,
        public DagannothSupreme $dagannoth_supreme,
        public DerangedArchaeologist $deranged_archaeologist,
        public DukeSucellus $duke_sucellus,
        public GeneralGraardor $general_graardor,
        public GiantMole $giant_mole,
        public GrotesqueGuardians $grotesque_guardians,
        public Hespori $hespori,
        public KalphiteQueen $kalphite_queen,
        public KingBlackDragon $king_black_dragon,
        public Kraken $kraken,

    ) {
    }
}
