<?php

namespace Roulette\Strategies;

use Roulette\Interfaces\Strategy;
use Roulette\Interfaces\Split;

class Martingale implements Strategy, Split
{
    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack)
    {
        if (
            $firstGo === false &&
            $playerWonOnPreviousRound === false &&
            is_null($lastBet) === false
        ) {
            return $playersStack->getDoubleAmount($lastBet);
        }

        return $playersStack->getAmount();
    }
}