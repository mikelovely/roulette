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

                echo "player bet - " . $bet_data['amount'] . ". remaining amount - " . $player->stack->getRemainingStack() . "\n";

                if ($bet_data['bet_type'] == 'odds') {
                    if (in_array($spin_result['value'], Wheel::getOddNumbers())) {
                        $player_round_win_status = true;
                        echo "player wins! - " . $bet_data['potential_win'] . "\n";
                        $player->stack->addToRemainingStack($bet_data['potential_win']);
                    }
                }

                $player->playerWonOnPreviousRound($player_round_win_status);

            }
        }
    }
}
