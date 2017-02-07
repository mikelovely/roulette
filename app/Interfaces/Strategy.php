<?php

namespace Roulette\Interfaces;

interface Strategy {
    public function makeBet($firstGo, $playerWonOnPreviousRound, $lastBet, $playersStack);
}
