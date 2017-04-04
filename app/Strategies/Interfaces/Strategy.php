<?php

namespace Roulette\Strategies\Interfaces;

interface Strategy {
    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack);
}
