<?php

namespace Roulette\Strategies;

use Roulette\Interfaces\Strategy;

class None implements Strategy
{
    public function makeBet(bool $firstGo, int $lastBet)
    {
        $this->stack->getAmount();
    }
}