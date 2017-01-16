<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;
use Roulette\Interfaces\Doublable as DoublableInterface;
use Roulette\Traits\Doublable as DoublableTrait;

class Odds extends Bet implements DoublableInterface
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
                'amount' => $this->amount,
                'potential_win' => 2 * $this->amount,
                'bet_type' => 'odds',
            ],
        ];
    }
}
