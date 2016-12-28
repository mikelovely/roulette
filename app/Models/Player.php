<?php

namespace Roulette\Models;

use Roulette\Roulette\Bet;

class Player
{
    private $strategy;
    private $pace;
    private $preference;
    private $bets;
    private $stake;
    private $active;
    private $id;

    public function __construct($strategy, $amount)
    {
        $this->active = false;
        $this->id = (string) "id_" . bin2hex(random_bytes(15));

        $this->setStrategy($strategy);
        $this->setStake($amount);
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

    private function setStake($amount)
    {
        if ($amount > 0) {
            $this->active = true;
        }

        $this->stake = $amount;
    }

    public function updateStake($amount)
    {
        $this->stake = ($this->stake + ($amount));

        // player is not active if they have no money left
        if ($this->stake == 0) {
            $this->active = false;
        }
    }

    public function getStake()
    {
        return $this->stake;
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

        $this->updateStake(-5);

        $bet = new Bet(10);
        return $bet->basic();
    }

    public function isActive()
    {   
        // this shouldn't happen - so force player to be inactive.
        if ($this->stake == 0 && $this->active == true) {
            $this->active = false;
        }

        return $this->active;
    }
}
