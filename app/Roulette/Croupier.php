<?php

namespace Roulette\Roulette;

use Roulette\Roulette\Wheel;
use Roulette\Interfaces\Split;
use Roulette\Interfaces\Straight;

class Croupier
{
    public function spin()
    {
        return Wheel::getNumber();
    }

    /**
     * Public method to handle each player per rounds result (so after the wheel has spun)
     */
    public function handleResult($spin_result, $players)
    {
        foreach ($players as $player) {
            $this->handlePlayer($spin_result, $player);
        }
    }

    /**
     * Do this once per player. Compare the bet infoamtion.
     */
    private function handlePlayer($spin_result, $player)
    {
        $player_round_win_status = false;

        // Why is there more than one bet per player per round? That's how betting works in Roulette
        // In real life, players will put different amounts on different numbers during a round
        // It's not like the movies.
        foreach ($player->current_bet->getBetData() as $bet_data) {

            // "even_money" means Red, Black, Odds or Evens
            if ($player->current_bet::BET_TYPE == "even_money") {
                if (in_array($spin_result['value'], $player->current_bet->winningNumbers())) {
                    $player_round_win_status = true;
                    $player->stack->addToRemainingStack($bet_data['potential_win']);
                }
            }

            // "straight_up" means a bet on 36/1 odds.
            if ($player->current_bet::BET_TYPE == "straight_up") {
                if ($spin_result['value'] == $bet_data['number']) {
                    $player_round_win_status = true;
                    $player->stack->addToRemainingStack($bet_data['potential_win']);
                }
            }
        }

        // Need to know if the Player won on the previous round so they can "decide"
        // to double their bet if they're playing Martingale strategy
        $player->previousRoundResults($player_round_win_status);
    }
}
