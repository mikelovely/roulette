<?php

namespace Roulette\Strategies;

use Roulette\Strategies\Interfaces\Strategy;

class Martingale implements Strategy
{
    const TYPE = 'splitter';

    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack)
    {
        if (
            $firstGo === false &&
            $playerWonOnPreviousRound === false &&
            is_null($lastBet) === false
        ) {
            return $playersStack->getDoubleAmount($lastBet->getAmount());
        }

        return $playersStack->getAmount();
    }
}
