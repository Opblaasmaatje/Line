<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\AbyssalSire;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\AlchemicalHydra;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Amoxliatl;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Araxxor;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Artio;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Barrows;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Bryophyta;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Callisto;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Calvarion;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Cerberus;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\ChambersOfXeric;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\ChambersOfXericChallengeMode;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\ChaosElemental;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\ChaosFanatic;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\CommanderZilyana;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\CorporealBeast;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\CrazyArchaeologist;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\DagannothPrime;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\DagannothRex;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\DagannothSupreme;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\DerangedArchaeologist;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\DukeSucellus;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\GeneralGraardor;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\GiantMole;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\GrotesqueGuardians;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Hespori;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\KalphiteQueen;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\KingBlackDragon;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Kraken;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Kreearra;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\KrilTsutsaroth;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Mimic;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Moons;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Nex;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Nightmare;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Obor;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\PhantomMuspah;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\PhosanisNightmare;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Sarachnis;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Scorpia;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Scurrius;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Skotizo;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\SolHeredit;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Spindel;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Tempoross;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheatreOfBlood;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheatreOfBloodHardMode;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheCorruptedGauntlet;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheGauntlet;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheHueycoatl;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheLeviathan;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\ThermonuclearSmokeDevil;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheRoyalTitans;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TheWhisperer;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TombsOfAmascut;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TombsOfAmascutExpert;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TzkalZuk;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\TztokJad;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Vardorvis;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Venenatis;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Vetion;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Vorkath;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Wintertodt;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Yama;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Zalcano;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Zulrah;

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
        public ChambersOfXericChallengeMode $chambers_of_xeric_challenge_mode,
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
        public PhosanisNightmare $phosanis_nightmare,
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
        public TheWhisperer $the_whisperer,
        public TheatreOfBlood $theatre_of_blood,
        public TheatreOfBloodHardMode $theatre_of_blood_hard_mode,
        public ThermonuclearSmokeDevil $thermonuclear_smoke_devil,
        public TombsOfAmascut $tombs_of_amascut,
        public TombsOfAmascutExpert $tombs_of_amascut_expert,
        public TzkalZuk $tzkal_zuk,
        public TztokJad $tztok_jad,
        public Venenatis $venenatis,
        public Vardorvis $vardorvis,
        public Vetion $vetion,
        public Vorkath $vorkath,
        public Wintertodt $wintertodt,
        public Yama $yama,
        public Zalcano $zalcano,
        public Zulrah $zulrah
    ) {
    }
}
