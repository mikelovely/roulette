<?php

namespace Roulette\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Roulette\Players\Player;
use Roulette\Roulette\Croupier;
use Roulette\Roulette\Simulation;
use Roulette\Strategies\Martingale;
use Roulette\Strategies\None;
use Roulette\Styles\Cautious;
use Roulette\Styles\Aggressive;

class SimulationController
{
    public function index(Request $request = null, Response $response = null)
    {
        // get a croupier
        $croupier = new Croupier();

        $martingale = new Martingale;
        $none = new None;

        $cautious = new Cautious;
        $aggressive = new Aggressive;

        // add players to the game
        $players = [];
        $players[] = new Player($martingale, 100, $cautious);
        $players[] = new Player($martingale, 1000, $aggressive);
        $players[] = new Player($none, 1000, $cautious);
        $players[] = new Player($martingale, 100, $cautious);
        $players[] = new Player($none, 10000, $aggressive);
        $players[] = new Player($none, 1000, $cautious);

        // run simulation
        $simulation = new Simulation($croupier, $players);
        $simulation->run();
    }
}
