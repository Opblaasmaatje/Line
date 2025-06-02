<?php

namespace App\Wise\Client\Players\DTO;

enum Build: string
{
    case Main = 'main';
    case F2p = 'f2p';
    case Lvl3 = 'lvl3';
    case Zerker = 'zerker';
    case Def1 = 'def1';
    case Hp10 = 'hp10';
    case F2pLvl3 = 'f2p_lvl3';
}
