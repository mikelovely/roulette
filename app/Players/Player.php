<?php

namespace Roulette\Players;

use Roulette\Players\Stack;
use Roulette\Interfaces\Strategy;
use Roulette\Interfaces\Style;
use Roulette\Interfaces\Strategies\Splitter;
use Roulette\Interfaces\Strategies\Standard;

class Player
{
    public $stack;
    public $current_bet;

    private $last_bet;
    private $strategy;
    private $style;
    private $name;
    private $player_won_on_previous_round;
    private $bet_type;
    private $out_of_game;
    private $first_go;

    use Data;

    public function __construct(Strategy $strategy, $amount, Style $style)
    {
        $faker = \Faker\Factory::create();
        $this->name = $faker->firstName() . " " . $faker->lastName;
        $this->setInitialVariables();
        $this->strategy = $strategy;
        $this->style = $style;
        $this->setBetType();
        $this->stack = new Stack($amount, $this->style);
    }

    public function makeBet()
    {
        $class = "Roulette\\Bets\\" . ucfirst($this->bet_type);

        $this->current_bet = new $class(
            $this->strategy->makeBet(
                $this->first_go,
                $this->player_won_on_previous_round,
                $this->last_bet,
                $this->stack
            )
        );

        $this->first_go = false;
        $this->last_bet = $this->current_bet;
    }

    public function previousRoundResults($boolean)
    {
        $this->player_won_on_previous_round = (boolean) $boolean;
    }

    public function isActive()
    {   
        if ($this->out_of_game) {
            return false;
        }

        if ($this->stack->getRemainingStack() >= $this->stack->getInitialStack() * 5) {
            echo "big win! " . $this->name . " wins $" . $this->stack->getRemainingStack() . "\n";
            $this->out_of_game = true;
            return false;
        }

        if ($this->stack->getRemainingStack() <= 0) {
            echo "house wins, sorry buddy. " . $this->name . " down to $" . $this->stack->getRemainingStack() . "\n";
            $this->out_of_game = true;
            return false;
        }

        return true;
    }

    public function setBetType()
    {
        if ($this->strategy instanceOf Splitter) {
            $array = [
                'red',
                'black',
                'odds',
                'evens',
            ];
            $k = array_rand($array);
            $bet = $array[$k];
        } elseif ($this->strategy instanceOf Standard) {
            $bet = 'straightUp';
        }

        $this->bet_type = $bet;
    }
}
