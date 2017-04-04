<?php

namespace Roulette\Bets;

use Roulette\Bets\Bet;
use Roulette\Bets\Interfaces\Bettable;
use Roulette\Roulette\Wheel;

class StraightUp extends Bet implements Bettable
{
    public function getBetData()
    {
        $a = [];
        if (rand(1,3) == 1 && $this->getAmount() % 5 == 0) {
            foreach ($this->setNeighbourSpread() as $key => $value) {
                $a[] = [
                    'potential_win' => ($this->getAmount() / 5) * 36,
                    'number' => $value['value'],
                ];
            }
        } else {
            foreach ($this->setSpread() as $key => $value) {
                $a[] = [
                    'potential_win' => $value * 36,
                    'number' => rand(0, 36),
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

        while (array_sum($groups) != $this->getAmount()) {
            $groups[$group] = rand(1, $this->getAmount());
            if (++$group == $number_of_groups) {
                $group = 0;
            }
        }

        return $groups;
    }
}
