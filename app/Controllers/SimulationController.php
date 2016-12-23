<?php

namespace Roulette\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Roulette\Models\Player;
use Roulette\Roulette\Croupier;
use Roulette\Roulette\Simulation;
use Roulette\Roulette\Table;

class SimulationController
{
    public function index(Request $request, Response $response)
    {
        // to begin the simulation you need the following;
        $croupier = new Croupier();

        // ---------------------------- //

        $players = [];

        $player = new Player();
        $player->setStake(100);
        $player->setStrategy('basic');
        // $player->setPace('adventurous'); // cautious, balanced, adventurous
        $players[] = $player;

        /* add more players */

        // ---------------------------- //

        $table = new Table();
        $table->collateBets();

        // ---------------------------- //

        $simulation = new Simulation($croupier, $table, $players);
        $simulation->run();

        // ---------------------------- //
    }
}
