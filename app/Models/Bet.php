<?php

namespace Roulette\Models;

class Bet
{
    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function basic()
    {
        $a = [];
        $spread = $this->setSpread();

        foreach ($spread as $key => $value) {
            $a[] = [
                'amount' => $value,
                'number' => rand(0, 36),
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
