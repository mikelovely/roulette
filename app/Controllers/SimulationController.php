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
        // get a croupier

        // ---------------------------- //
        // add players to the game

        $players = [];

        $player = new Player('martingale', 100);
        
        // $player->setPace('adventurous'); // cautious, balanced, adventurous
        $players[] = $player;

        /* add more players */

        // ---------------------------- //
        // add the table

        $table = new Table();
        $table->collateBets();

        // ---------------------------- //
        // run the simulation

        $simulation = new Simulation($croupier, $table, $players);
        $simulation->run();

        // ---------------------------- //
    }
}
