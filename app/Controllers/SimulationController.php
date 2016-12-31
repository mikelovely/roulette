<?php

namespace Roulette\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Roulette\Models\Player;
use Roulette\Roulette\Croupier;
use Roulette\Roulette\Simulation;

class SimulationController
{
    public function index(Request $request, Response $response)
    {
        // get a croupier
        $croupier = new Croupier();

        // add players to the game
        $players = [];
        $players[] = new Player('martingale', 100, 'cautious');

        // run simulation
        $simulation = new Simulation($croupier, $players);
        $simulation->run();
    }
}
