<?php

namespace Roulette\Roulette;

use Roulette\Roulette\Wheel;

class Croupier
{
    public function spin()
    {
        $result = Wheel::getNumber();

        $this->handleResult($result);
    }

    public function handleResult($result)
    {
        // take the result of the spin

        // get the bets from the players

        // dole out winnings if any
    }
}
