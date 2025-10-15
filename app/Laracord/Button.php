<?php

namespace App\Laracord;

use Discord\Builders\Components\Button as BaseButton;

/**
 * This class is here to overwrite these consts which make php-stan shut up.
 */
class Button extends BaseButton
{
    public const STYLE_PRIMARY = '1';

    public const STYLE_SECONDARY = '2';

    public const STYLE_SUCCESS = '3';

    public const STYLE_DANGER = '4';

    public const STYLE_LINK = '5';

    public const STYLE_PREMIUM = '6';
}
