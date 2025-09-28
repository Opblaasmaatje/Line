<?php

namespace App\Wise\Client\Enums;

enum Metric: string
{
    //Skill
    case OVERALL = 'overall';
    case ATTACK = 'attack';
    case DEFENCE = 'defence';
    case STRENGTH = 'strength';
    case HITPOINTS = 'hitpoints';
    case RANGED = 'ranged';
    case PRAYER = 'prayer';
    case MAGIC = 'magic';
    case COOKING = 'cooking';
    case WOODCUTTING = 'woodcutting';
    case FLETCHING = 'fletching';
    case FISHING = 'fishing';
    case FIREMAKING = 'firemaking';
    case CRAFTING = 'crafting';
    case SMITHING = 'smithing';
    case MINING = 'mining';
    case HERBLORE = 'herblore';
    case AGILITY = 'agility';
    case THIEVING = 'thieving';
    case SLAYER = 'slayer';
    case FARMING = 'farming';
    case RUNECRAFTING = 'runecrafting';
    case HUNTER = 'hunter';
    case CONSTRUCTION = 'construction';

    //Boss
    case ABYSSAL_SIRE = 'abyssal_sire';
    case ALCHEMICAL_HYDRA = 'alchemical_hydra';
    case AMOXLIATL = 'amoxliatl';
    case ARAXXOR = 'araxxor';
    case ARTIO = 'artio';
    case BARROWS_CHESTS = 'barrows_chests';
    case BRYOPHYTA = 'bryophyta';
    case CALLISTO = 'callisto';
    case CALVARION = 'calvarion';
    case CERBERUS = 'cerberus';
    case CHAMBERS_OF_XERIC = 'chambers_of_xeric';
    case CHAMBERS_OF_XERIC_CHALLENGE_MODE = 'chambers_of_xeric_challenge_mode';
    case CHAOS_ELEMENTAL = 'chaos_elemental';
    case CHAOS_FANATIC = 'chaos_fanatic';
    case COMMANDER_ZILYANA = 'commander_zilyana';
    case CORPOREAL_BEAST = 'corporeal_beast';
    case CRAZY_ARCHAEOLOGIST = 'crazy_archaeologist';
    case DAGANNOTH_PRIME = 'dagannoth_prime';
    case DAGANNOTH_REX = 'dagannoth_rex';
    case DAGANNOTH_SUPREME = 'dagannoth_supreme';
    case DERANGED_ARCHAEOLOGIST = 'deranged_archaeologist';
    case DUKE_SUCELLUS = 'duke_sucellus';
    case GENERAL_GRAARDOR = 'general_graardor';
    case GIANT_MOLE = 'giant_mole';
    case GROTESQUE_GUARDIANS = 'grotesque_guardians';
    case HESPORI = 'hespori';
    case KALPHITE_QUEEN = 'kalphite_queen';
    case KING_BLACK_DRAGON = 'king_black_dragon';
    case KRAKEN = 'kraken';
    case KREEARRA = 'kreearra';
    case KRIL_TSUTSAROTH = 'kril_tsutsaroth';
    case LUNAR_CHESTS = 'lunar_chests';
    case MIMIC = 'mimic';
    case NEX = 'nex';
    case NIGHTMARE = 'nightmare';
    case PHOSANIS_NIGHTMARE = 'phosanis_nightmare';
    case OBOR = 'obor';
    case PHANTOM_MUSPAH = 'phantom_muspah';
    case SARACHNIS = 'sarachnis';
    case SCORPIA = 'scorpia';
    case SCURRIUS = 'scurrius';
    case SKOTIZO = 'skotizo';
    case SOL_HEREDIT = 'sol_heredit';
    case SPINDEL = 'spindel';
    case TEMPOROSS = 'tempoross';
    case THE_GAUNTLET = 'the_gauntlet';
    case THE_CORRUPTED_GAUNTLET = 'the_corrupted_gauntlet';
    case THE_HUEYCOATL = 'the_hueycoatl';
    case THE_LEVIATHAN = 'the_leviathan';
    case THE_ROYAL_TITANS = 'the_royal_titans';
    case THE_WHISPERER = 'the_whisperer';
    case THEATRE_OF_BLOOD = 'theatre_of_blood';
    case THEATRE_OF_BLOOD_HARD_MODE = 'theatre_of_blood_hard_mode';
    case THERMONUCLEAR_SMOKE_DEVIL = 'thermonuclear_smoke_devil';
    case TOMBS_OF_AMASCUT = 'tombs_of_amascut';
    case TOMBS_OF_AMASCUT_EXPERT = 'tombs_of_amascut_expert';
    case TZKAL_ZUK = 'tzkal_zuk';
    case TZTOK_JAD = 'tztok_jad';
    case VARDORVIS = 'vardorvis';
    case VENENATIS = 'venenatis';
    case VETION = 'vetion';
    case VORKATH = 'vorkath';
    case WINTERTODT = 'wintertodt';
    case YAMA = 'yama';
    case ZALCANO = 'zalcano';
    case ZULRAH = 'zulrah';

    //Computed Metric
    case EHP = 'ehp';
    case EHB = 'ehb';

}
