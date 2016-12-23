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
            foreach ($this->players as $player) {
                if ($player->isActive()) {
                    $continue = true;
                    continue;
                }
            }

            // var_dump($continue);

            $bets = [];

            if ($continue) {
                foreach ($this->players as $player) {
                    $bets[$player->getId()] = $player->makeBet();
                    var_dump($player->getStake());
                }
            }

            // $number = $this->croupier->spin();
            // $this->croupier->handleResults($number, $bets);
        } while ($continue);

        exit;
    }
}
