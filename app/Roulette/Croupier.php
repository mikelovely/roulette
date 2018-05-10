<?php

namespace Roulette\Roulette;

use Roulette\Bets\Handlers\EvenMoney;
use Roulette\Bets\Handlers\StraightUp;
use Roulette\Bets\Handlers\Exceptions\BetHandlerNotFoundException;
use Roulette\Roulette\Wheel;
use Roulette\Interfaces\Split;
use Roulette\Interfaces\Straight;
use Roulette\Library\Adapters\Logger;

class Croupier
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function spin()
    {
        return Wheel::getNumber();
    }

    /**
     * Public method to handle each player per rounds result (so after the wheel has spun)
     */
    public function playRound($players)
    {
        $spin_result = $this->spin();

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

        // TODO: pass all data to a master handler instead??
        foreach ($player->current_bet->getBetData() as $bet_data) {

            $betHandler = null;

            switch ($player->current_bet::BET_TYPE) {
                case "even_money":
                    $betHandler = new EvenMoney($spin_result, $player, $bet_data, $this->logger);
                    break;
                case "straight_up":
                    $betHandler = new StraightUp($spin_result, $player, $bet_data, $this->logger);
                    break;
            }

            if (!$betHandler) {
                throw new BetHandlerNotFoundException("No bet handler found for " . $player->current_bet::BET_TYPE, 1);
            }

            $result = $betHandler->handle();

            if ($result === true && $player_round_win_status === false) {
                $player_round_win_status = true;
            }
        }

        // Need to know if the Player won on the previous round so they can "decide"
        // to double their bet if they're playing Martingale strategy
        $player->previousRoundResults($player_round_win_status);
    }
}
