<?php

namespace Roulette\Roulette;

use Roulette\Roulette\Croupier;
use Roulette\Models\Player;
use Roulette\Models\Table;

class Simulation
{
    private $croupier;
    private $table;
    private $players;

    public function __construct(Croupier $croupier, Table $table, $players)
    {
        $this->croupier = $croupier;
        $this->table = $table;
        $this->players = $players;
    }

    public function addPlayer(Player $player)
    {
        $this->players[$player];
    }

    public function run()
    {
        $players = true;

        do {
            $bets = [];
            foreach ($this->players as $player) {
                if ($player->isActive()) {
                    $bets[] = $player->makeBet();
                    break; // break out of the foreach loop because there is still an active player
                }
                $players = false;
            }
            $number = $this->croupier->spin();
            $this->croupier->handleResults($number, $bets);
        } while ($players);
    }
}
