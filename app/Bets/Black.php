<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;

class Black extends Bet
{
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
                'bet_type' => 'black',
            ],
        ];
    }
}