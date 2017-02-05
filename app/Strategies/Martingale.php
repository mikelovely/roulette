<?php

namespace Roulette\Strategies;

// use Roulette\Traits\Doublable as DoublableTrait;
// use Roulette\Interfaces\Doublable as DoublableInterface;
use Roulette\Interfaces\Strategy;

class Martingale implements Strategy
{
    // use DoublableTrait;

    public function makeBet(bool $firstGo, $lastBet)
    {
        return $this->stack->getDoubleAmount($lastBet);
    }
}