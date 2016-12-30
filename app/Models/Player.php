<?php

namespace Roulette\Models;

use Roulette\Roulette\Bet;
use Roulette\Roulette\Stack;

class Player
{
    private $strategy;
    private $pace;
    private $preference;
    private $bets;
    public $stack;
    private $id;

    public function __construct($strategy, $amount)
    {
        $this->id = (string) "id_" . bin2hex(random_bytes(15));

        $this->setStrategy($strategy);

        $this->stack = new Stack($amount);
    }

    private function setStrategy($strategy)
    {
        $class = "Roulette\\Models\\Strategies\\" . ucfirst($strategy);
        $this->strategy = new $class();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }

    public function setPace($pace)
    {
        $this->pace = $pace;
    }

    public function leaveTable()
    {
        // stop the simulation if not yet out of money.
    }

    public function makeBet()
    {
        // based on how much stake player has left
        // and the strategy they are using
        // and the pace they are playing

        $bet = new Bet($this->stack->getLargeAmount());

        $bet = new Bet(10);
        return $bet->basic();
    }

    public function isActive()
    {   
        if ($this->stack->getRemainingStack() >= $this->stack->getInitialStack() * 10) {
            var_dump("player wins big!");
            var_dump($this->stack->getRemainingStack());
            return false;
        }

        if ($this->stack->getRemainingStack() <= 0) {
            var_dump("house wins, sorry buddy.");
            var_dump($this->stack->getRemainingStack());
            return false;
        }

        return true;
    }
}
