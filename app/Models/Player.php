<?php

namespace Roulette\Models;

use Roulette\Roulette\Bet;
use Roulette\Roulette\Stack;

class Player
{
    private $strategy;
    private $style;
    public $stack;
    private $id;
    private $player_won_on_previous_round;
    public $current_bet;
    public $last_bet;

    public function __construct($strategy, $amount, $style)
    {
        $this->player_won_on_previous_round = false;

        $this->id = (string) "id_" . bin2hex(random_bytes(15));

        $this->setStrategy($strategy);

        $this->setStyle($style);

        $this->stack = new Stack($amount);

        $this->first_go = true;
    }

    private function setStrategy($strategy)
    {
        $class = "Roulette\\Strategies\\" . ucfirst($strategy);
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

    public function setStyle($style)
    {
        $class = "Roulette\\Styles\\" . ucfirst($style);
        $this->style = new $class();
    }

    public function getLastBet()
    {
        return $this->last_bet;
    }

    public function setLastBet($bet)
    {
        $this->last_bet = $bet;
    }

    public function makeBet()
    {
        if ($this->player_won_on_previous_round === false && $this->first_go === false && $this->strategy->getName() == 'martingale') {
            $this->current_bet = new \Roulette\Bets\Odds($this->stack->getDoubleAmount($this->last_bet->getAmount()));
            $this->setLastBet($this->current_bet);
            return;
        }
        
        $this->first_go = false;

        $this->current_bet = new \Roulette\Bets\StraightUp($this->stack->getAmount($this->style));

        $this->setLastBet($this->current_bet);
    }

    public function playerWonOnPreviousRound($boolean)
    {
        $this->player_won_on_previous_round = (boolean) $boolean;
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
