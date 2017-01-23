<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;
use Roulette\Interfaces\Doublable as DoublableInterface;
use Roulette\Interfaces\Split as SplitInterface;
use Roulette\Roulette\Wheel;
use Roulette\Traits\Doublable as DoublableTrait;

class Evens extends Bet implements DoublableInterface, SplitInterface
{
    use DoublableTrait;

    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getBetData()
    {
        return [
            0 => [
                'potential_win' => 2 * $this->amount,
                'bet_type' => 'evens',
            ],
        ];
    }

    public function winningNumbers()
    {
        return Wheel::getEvenNumbers();
    }
}
