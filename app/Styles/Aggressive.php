<?php

namespace Roulette\Styles;

use Roulette\Styles\Interfaces\Style;

class Aggressive implements Style
{
    const WALK_AWAY = 10;

    public function getAmount($initialStack)
    {
        return (float) round(($initialStack / 100) * rand(25, 40));
    }
}
