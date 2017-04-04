<?php

namespace Roulette\Strategies;

use Roulette\Strategies\Interfaces\Strategy;

class None implements Strategy
{
    const TYPE = 'standard';

    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack)
    {
        return $playersStack->getAmount();
    }
}
