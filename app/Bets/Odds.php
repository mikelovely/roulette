<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;
use Roulette\Interfaces\Doublable as DoublableInterface;
use Roulette\Interfaces\Split as SplitInterface;
use Roulette\Roulette\Wheel;
use Roulette\Traits\Doublable as DoublableTrait;

class Odds extends Bet implements DoublableInterface, SplitInterface
{
    use DoublableTrait;

    public function getBetData()
    {
        return [
            0 => [
                'potential_win' => 2 * $this->getAmount(),
            ],
        ];
    }

    public function winningNumbers()
    {
        return Wheel::getOddNumbers();
    }
}
