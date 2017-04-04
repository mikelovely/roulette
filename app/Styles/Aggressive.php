<?php

namespace Roulette\Styles;

use Roulette\Styles\Interfaces\Style;

class Aggressive implements Style
{
    public function getAmount($initialStack)
    {
        return (float) round(($initialStack / 100) * rand(25, 40));
    }
}
