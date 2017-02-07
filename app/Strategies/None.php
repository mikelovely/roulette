<?php

namespace Roulette\Strategies;

use Roulette\Interfaces\Strategy;
use Roulette\Interfaces\Strategies\Standard;

class None implements Strategy, Standard
{
    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack)
    {
        return $playersStack->getAmount();
    }
}