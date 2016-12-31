<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;

class Red extends Bet
{
    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function getBetData()
    {
        return [
            0 => [
                'amount' => $this->amount,
                'potential_win' => 2 * $this->amount,
                'bet_type' => 'red',
            ],
        ];
    }
}