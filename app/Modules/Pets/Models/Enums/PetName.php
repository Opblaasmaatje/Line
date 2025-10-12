<?php

namespace App\Modules\Pets\Models\Enums;

use App\Helpers\Enums\Concerns\AsHeadline;
use App\Helpers\Enums\Concerns\Searchable;

enum PetName: string
{
    use AsHeadline;
    use Searchable;

    case PET_CHAOS_ELEMENTAL = 'Pet chaos elemental';
    case PET_DAGANNOTH_SUPREME = 'Pet dagannoth supreme';
    case PET_DAGANNOTH_PRIME = 'Pet dagannoth prime';
    case PET_DAGANNOTH_REX = 'Pet dagannoth rex';
    case PET_PENANCE_QUEEN = 'Pet penance queen';
    case PET_KREE_ARRA = "Pet kree'arra";
    case PET_GENERAL_GRAARDOR = 'Pet general graardor';
    case PET_ZILYANA = 'Pet zilyana';
    case PET_KRIL_TSUTSAROTH = "Pet k'ril tsutsaroth";
    case BABY_MOLE = 'Baby mole';
    case PRINCE_BLACK_DRAGON = 'Prince black dragon';
    case KALPHITE_PRINCESS = 'Kalphite princess';
    case PET_SMOKE_DEVIL = 'Pet smoke devil';
    case PET_KRAKEN = 'Pet kraken';
    case PET_DARK_CORE = 'Pet dark core';
    case PET_SNAKELING = 'Pet snakeling';
    case CHOMPY_CHICK = 'Chompy chick';
    case VENENATIS_SPIDERLING = 'Venenatis spiderling';
    case CALLISTO_CUB = 'Callisto cub';
    case VETION_JR = "Vet'ion jr.";
    case SCORPIAS_OFFSPRING = "Scorpia's offspring";
    case TZREK_JAD = 'Tzrek-jad';
    case HELLPUPPY = 'Hellpuppy';
    case ABYSSAL_ORPHAN = 'Abyssal orphan';
    case HERON = 'Heron';
    case ROCK_GOLEM = 'Rock golem';
    case BEAVER = 'Beaver';
    case BABY_CHINCHOMPA = 'Baby chinchompa';
    case BLOODHOUND = 'Bloodhound';
    case GIANT_SQUIRREL = 'Giant squirrel';
    case TANGLEROOT = 'Tangleroot';
    case RIFT_GUARDIAN = 'Rift guardian';
    case ROCKY = 'Rocky';
    case PHOENIX = 'Phoenix';
    case OLMLET = 'Olmlet';
    case SKOTOS = 'Skotos';
    case JAL_NIB_REK = 'Jal-nib-rek';
    case HERBI = 'Herbi';
    case NOON = 'Noon';
    case VORKI = 'Vorki';
    case LIL_ZIK = "Lil' zik";
    case IKKLE_HYDRA = 'Ikkle hydra';
    case SRARACHA = 'Sraracha';
    case YOUNGLLEF = 'Youngllef';
    case SMOLCANO = 'Smolcano';
    case LITTLE_NIGHTMARE = 'Little nightmare';
    case LIL_CREATOR = "Lil' creator";
    case TINY_TEMPOR = 'Tiny tempor';
    case NEXLING = 'Nexling';
    case ABYSSAL_PROTECTOR = 'Abyssal protector';
    case TUMEKENS_GUARDIAN = "Tumeken's guardian";
    case MUPHIN = 'Muphin';
    case WISP = 'Wisp';
    case BUTCH = 'Butch';
    case LIL_VIATHAN = "Lil'viathan";
    case BARON = 'Baron';
    case SCURRY = 'Scurry';
    case SMOL_HEREDIT = 'Smol heredit';
    case QUETZIN = 'Quetzin';
    case NID = 'Nid';
    case HUBERTE = 'Huberte';
    case MOXI = 'Moxi';
    case BRAN = 'Bran';
    case YAMI = 'Yami';
    case DOM = 'Dom';
}
