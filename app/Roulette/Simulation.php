<?php

namespace Roulette\Roulette;

use Roulette\Roulette\Croupier;

class Simulation
{
    private $croupier;
    private $players = [];

    public function __construct(Croupier $croupier, $players)
    {
        $this->croupier = $croupier;
        $this->players = $players;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function run()
    {
        do {
            $continue = false;

            // do this each round to determine who is still able to play
            // (which players still have money)
            foreach ($this->players as $player) {
                if ($player->isActive()) {
                    $continue = true;
                    $player->makeBet();
                } else {
                    // couldn't think of a better place to output a players final status
                    echo $player->getStatus() . "\n";

                    // remove player from the simulation as we have no interest in them anymore. it should be the
                    // final responsibility of the simulation to remove a player if he/she has no more money.
                    if (($key = array_search($player, $this->players)) !== false) {
                        unset($this->players[$key]);
                    }
                }
            }

            if ($continue) {
                // number returned from a spin of the wheel
                $spin_result = $this->croupier->spin();

                // bets are handled by the croupier along with the number spun
                $this->croupier->handleResult($spin_result, $this->players);
            }
        } while ($continue);

        echo "betting ends" . "\n";
    }
}
