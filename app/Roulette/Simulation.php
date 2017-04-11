<?php

namespace Roulette\Roulette;

use Roulette\Roulette\Croupier;

class Simulation
{
    private $croupier;
    private $players = [];
    private $logger;

    public function __construct(Croupier $croupier, $players, $logger)
    {
        $this->croupier = $croupier;
        $this->players = $players;
        $this->logger = $logger;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function run()
    {
        do {
            $continue = false;

            // Do this each round to determine who is still able to play (still have money or limit not reached)
            foreach ($this->players as $player) {
                if ($player->isActive()) {
                    $continue = true;
                    // Player actually makes a bet
                    $this->logger->info("{$player->getName()} is making a bet.");
                    $player->makeBet();
                } else {
                    // I couldn't think of a better place to output a players final status
                    echo $player->getStatus() . "\n";

                    // Remove player from the simulation as we have no interest in them anymore. It should be the
                    // final responsibility of the simulation to remove a player if he/she has no more money.
                    if (($key = array_search($player, $this->players)) !== false) {
                        $this->logger->info("{$player->getName()} is being removed from simulation.");
                        unset($this->players[$key]);
                    }
                }
            }

            if ($continue) {
                // Number returned from a spin of the wheel
                $spin_result = $this->croupier->spin();

                // Bets are handled by the croupier along with the number spun
                $this->croupier->handleResult($spin_result, $this->players);
            }
        } while ($continue);

        $this->logger->info('Simulation has ended.');
        echo "Simulation has ended" . "\n";
    }
}
