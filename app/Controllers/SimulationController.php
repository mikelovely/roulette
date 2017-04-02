<?php

namespace Roulette\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Roulette\Players\Player;
use Roulette\Players\Stack;
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
        $croupier = new Croupier;

        $martingale = new Martingale;
        $none = new None;

        $cautious = new Cautious;
        $aggressive = new Aggressive;

        // add players to the game
        $players = [];

        $players[] = new Player($none, new Stack(mt_rand(100, 1000), $cautious), $cautious);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $cautious), $cautious);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $cautious), $aggressive);
        $players[] = new Player($none, new Stack(mt_rand(100, 1000), $cautious), $cautious);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $cautious), $aggressive);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $cautious), $cautious);
        $players[] = new Player($none, new Stack(mt_rand(100, 1000), $cautious), $aggressive);

        // run simulation
        $simulation = new Simulation($croupier, $players);
        $simulation->run();
    }
}
