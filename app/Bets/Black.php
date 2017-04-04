<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;
use Roulette\Bets\Interfaces\Bettable;
use Roulette\Roulette\Wheel;

class Black extends Bet implements Bettable
{
    const BET_TYPE = 'even_money';

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
