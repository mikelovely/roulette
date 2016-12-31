<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;

class StraightUp extends Bet
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
        $a = [];

        foreach ($this->setSpread() as $key => $value) {
            $a[] = [
                'amount' => $value,
                'potential_win' => $value * 36,
                'number' => rand(0, 36),
                'bet_type' => 'straight_up',
            ];
        }

        return $a;
    }

    private function setSpread()
    {
        $number_of_groups = rand(1, 5);
        $groups = [];
        $group = 0;

        while(array_sum($groups) != $this->amount) {
            $groups[$group] = rand(1, $this->amount);
            if(++$group == $number_of_groups) {
                $group = 0;
            }
        }

        return $groups;
    }
}
