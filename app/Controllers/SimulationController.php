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

class SimulationController extends Controller
{
    /**
     * This action is just an entry point to run the entire Simulation.
     * This should work from both the command line using; `$ php simulate run:simulation` and
     * also running from a browser or postman. eg http://localhost/simulate
     */
    public function index(Request $request = null, Response $response = null)
    {
        $this->logger->info('Starting the simulation.');

        // Every simulation needs a Croupier to manage the whole Simulation
        $croupier = new Croupier($this->logger);

        // These are just re-usable Strategies. All Players need a Strategy - even a basic one like "None"
        $martingale = new Martingale;
        $none = new None;

        // These are just re-usable Styles. This will determine how large a bet a PLayer will make
        // as a percentage of their remaining cash (Stack)
        $cautious = new Cautious;
        $aggressive = new Aggressive;

        // Add players to the game here. You can add as many as you like but they need;
        // - A playing Strategy
        // - A Stack (passing in the amount the player wants to bet with)
        // - A playing Style
        $players = [];

        $players[] = new Player($none, new Stack(mt_rand(100, 1000), $cautious), $cautious, $this->logger);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $cautious), $cautious, $this->logger);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $aggressive), $aggressive, $this->logger);
        $players[] = new Player($none, new Stack(mt_rand(100, 1000), $cautious), $cautious, $this->logger);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $aggressive), $aggressive, $this->logger);
        $players[] = new Player($martingale, new Stack(mt_rand(100, 1000), $cautious), $cautious, $this->logger);
        $players[] = new Player($none, new Stack(mt_rand(100, 1000), $aggressive), $aggressive, $this->logger);

        // Run simulation
        $simulation = new Simulation($croupier, $players, $this->logger);
        $simulation->run();
    }
}
