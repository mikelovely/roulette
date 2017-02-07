<?php

namespace Roulette\Strategies;

use Roulette\Interfaces\Strategy;
use Roulette\Interfaces\Straight;

class None implements Strategy, Straight
{
    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack)
    {
        return $playersStack->getAmount();
    }
}