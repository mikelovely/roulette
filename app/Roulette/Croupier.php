<?php

namespace Roulette\Roulette;

use Roulette\Roulette\Wheel;

class Croupier
{
    public function spin()
    {
        return Wheel::getNumber();
    }

    public function handleResult($number, $bets)
    {
        // take the result of the spin ($number)

        // get the bets from the players ($bets)

        // dole out winnings if any
    }
}
