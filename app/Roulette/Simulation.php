<?php

namespace Roulette\Roulette;

use Roulette\Models\Player;
use Roulette\Roulette\Croupier;
use Roulette\Roulette\Table;

class Simulation
{
    private $croupier;
    private $table;
    private $players = [];

    public function __construct(Croupier $croupier, Table $table, $players)
    {
        $this->croupier = $croupier;
        $this->table = $table;
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
                    continue;
                }
            }

            if ($continue) {
                // on every round, each player in the game places a bet
                foreach ($this->players as $player) {
                    $player->makeBet();
                }

                // number returned from a spin of the wheel
                $spin_result = $this->croupier->spin();

                // bets are handled by the croupier along with the number spun
                $this->croupier->handleResult($spin_result, $this->players);
            }
        } while ($continue);

        exit;
    }
}
