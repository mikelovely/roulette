<?php

namespace Roulette\Strategies;

use Roulette\Interfaces\Strategy;

class None implements Strategy
{
    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack)
    {
        return $playersStack->getAmount();
    }
}