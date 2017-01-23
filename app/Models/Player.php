<?php

namespace Roulette\Models;

use Roulette\Roulette\Bet;
use Roulette\Roulette\Stack;
use Roulette\Interfaces\Doublable;

class Player
{
    public $stack;
    public $current_bet;
    public $last_bet;
    
    private $strategy;
    private $style;
    private $id;
    private $player_won_on_previous_round;
    private $previous_round_bet_type;
    private $bet_type;
    private $out_of_game;

    public function __construct($strategy, $amount, $style)
    {
        $this->out_of_game = false;

        $this->player_won_on_previous_round = false;

        $this->id = (string) "id_" . bin2hex(random_bytes(15));

        $this->setStrategy($strategy);

        $this->setStyle($style);

        $this->setBetType();

        $this->stack = new Stack($amount);

        $this->first_go = true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setStrategy($strategy)
    {
        $class = "Roulette\\Strategies\\" . ucfirst($strategy);
        $this->strategy = new $class();
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
        if (
            $this->player_won_on_previous_round === false &&
            $this->first_go === false &&
            $this->strategy instanceOf Doublable &&
            $this->getLastBet() instanceOf Doublable
        ) {
            $class = get_class($this->getLastBet());
            $this->current_bet = new $class($this->stack->getDoubleAmount($this->last_bet->getAmount()));
            $this->setLastBet($this->current_bet);
            return;
        }
        
        $this->first_go = false;

        $class = "Roulette\\Bets\\" . ucfirst($this->bet_type);

        $this->current_bet = new $class($this->stack->getAmount($this->style));

        $this->setLastBet($this->current_bet);
    }

    public function previousRoundResults($boolean, $bet)
    {
        $this->player_won_on_previous_round = (boolean) $boolean;
        $this->previous_round_bet_type = $bet;
    }

    public function isActive()
    {   
        if ($this->out_of_game) {
            return false;
        }

        if ($this->stack->getRemainingStack() >= $this->stack->getInitialStack() * 5) {
            echo "big win! player " . $this->getId() . " wins $" . $this->stack->getRemainingStack() . "\n";
            $this->out_of_game = true;
            return false;
        }

        if ($this->stack->getRemainingStack() <= 0) {
            echo "house wins, sorry buddy. player " . $this->getId() . " loses everything" . "\n";
            $this->out_of_game = true;
            return false;
        }

        return true;
    }

    public function setBetType()
    {
        if ($this->strategy instanceOf Doublable) {
            $array = [
                'red',
                'black',
                'odds',
                'evens',
            ];
            $k = array_rand($array);
            $bet = $array[$k];
        } else {
            $bet = 'straightUp';
        }

        $this->bet_type = $bet;
    }
}
