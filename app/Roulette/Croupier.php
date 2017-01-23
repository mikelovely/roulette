<?php

namespace Roulette\Roulette;

use Roulette\Roulette\Wheel;

class Croupier
{
    public function spin()
    {
        return Wheel::getNumber();
    }

    public function handleResult($spin_result, $players)
    {
        foreach ($players as $player) {

            $player_round_win_status = false;

            foreach ($player->current_bet->getBetData() as $bet_data) {

                if (get_class($player->current_bet) instanceof Split) {
                    if (in_array($spin_result['value'], $player->current_bet->winningNumbers())) {
                        $player_round_win_status = true;
                        $player->stack->addToRemainingStack($bet_data['potential_win']);
                    }
                }

                if ($bet_data['bet_type'] == 'straight_up') {
                    if ($spin_result['value'] == $bet_data['number']) {
                        $player_round_win_status = true;
                        $player->stack->addToRemainingStack($bet_data['potential_win']);
                    }
                }

                $player->previousRoundResults($player_round_win_status, $bet_data['bet_type']);
            }
        }
    }
}
