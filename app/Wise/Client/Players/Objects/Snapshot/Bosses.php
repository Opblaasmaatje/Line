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
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TzkalZuk;
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
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Sarachnis;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Scorpia;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Scurrius;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Skotizo;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\SolHeredit;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Spindel;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Tempoross;
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
use App\Wise\Client\Players\Objects\Snapshot\Bosses\TztokJad;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Venenatis;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Vetion;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Wintertodt;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Yama;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Zalcano;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Zulrah;

readonly class Bosses extends Basket
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
        public Kreearra $kreearra,
        public KrilTsutsaroth $kril_tsutsaroth,
        public Moons $lunar_chests,
        public Mimic $mimic,
        public Nex $nex,
        public Nightmare $nightmare,
        public Obor $obor,
        public PhantomMuspah $phantom_muspah,
        public Sarachnis $sarachnis,
        public Scorpia $scorpia,
        public Scurrius $scurrius,
        public Skotizo $skotizo,
        public SolHeredit $sol_heredit,
        public Spindel $spindel,
        public Tempoross $tempoross,
        public TheGauntlet $the_gauntlet,
        public TheCorruptedGauntlet $the_corrupted_gauntlet,
        public TheHueycoatl $the_hueycoatl,
        public TheLeviathan $the_leviathan,
        public TheRoyalTitans $the_royal_titans,
        public TheWhisperer  $the_whisperer,
        public TheatreOfBlood $theatre_of_blood,
        public TheatreOfBloodHardMode $theatre_of_blood_hard_mode,
        public ThermonuclearSmokeDevil $thermonuclear_smoke_devil,
        public TombsOfAmascut $tombs_of_amascut,
        public TombsOfAmascutExpert $tombs_of_amascut_expert,
        public TzkalZuk $tzkal_zuk,
        public TztokJad $tztok_jad,
        public Venenatis $venenatis,
        public Vetion $vetion,
        public Wintertodt $wintertodt,
        public Yama $yama,
        public Zalcano $zalcano,
        public Zulrah $zulrah
    ) {
    }
}
