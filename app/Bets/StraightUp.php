<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;
use Roulette\Roulette\Wheel;

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

        if (rand(1,4) == 1) {
            foreach ($this->setNeighbourSpread() as $key => $value) {
                $a[] = [
                    'potential_win' => $value['value'] * 36,
                    'number' => rand(0, 36),
                    'bet_type' => 'straight_up',
                ];
            }
        } else {
            foreach ($this->setSpread() as $key => $value) {
                $a[] = [
                    'potential_win' => $value * 36,
                    'number' => rand(0, 36),
                    'bet_type' => 'straight_up',
                ];
            }
        }

        return $a;
    }

    private function setNeighbourSpread()
    {
        $number = rand(0, 36);

        return Wheel::getNeighbours($number);
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
