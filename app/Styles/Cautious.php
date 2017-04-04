<?php

namespace Roulette\Styles;

use Roulette\Styles\Interfaces\Style;

class Cautious implements Style
{
    public function getAmount($initialStack)
    {
        return (float) round(($initialStack / 100) * rand(5, 20));
    }
}
