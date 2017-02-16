<?php

namespace Roulette\Strategies;

use Roulette\Interfaces\Strategy;
use Roulette\Interfaces\Strategies\Splitter;

class Martingale implements Strategy, Splitter
{
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