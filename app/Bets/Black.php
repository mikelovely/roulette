<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;
use Roulette\Interfaces\Split;
use Roulette\Roulette\Wheel;

class Black extends Bet implements Split
{
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
        return Wheel::getBlackNumbers();
    }
}