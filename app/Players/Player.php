<?php

namespace Roulette\Players;

use Roulette\Strategies\Interfaces\Strategy;
use Roulette\Styles\Interfaces\Style;

class Player
{
    private $out_of_game;
    private $player_won_on_previous_round;
    private $first_go;
    private $name;
    private $strategy;
    public $stack;
    private $style;
    private $bet_type;
    public $status;
    public $current_bet;
    private $last_bet;

    use Status;

    public function __construct(Strategy $strategy, Stack $stack, Style $style)
    {
        $this->out_of_game = false;
        $this->player_won_on_previous_round = false;
        $this->first_go = true;
        $faker = \Faker\Factory::create();
        $this->name = $faker->firstName() . " " . $faker->lastName;
        $this->strategy = $strategy;
        $this->stack = $stack;
        $this->style = $style;
        $this->setBetType();
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

        // Player walks away if they have won their "Walk Away" amount (5 or 10 times initial buy-in)
        if ($this->stack->getRemainingStack() >= ($this->stack->getInitialStack() * $this->style::WALK_AWAY)) {
            $this->setStatus("win");
            $this->out_of_game = true;
            return false;
        }

        // Player is out of the game if their remaining Stack is zero
        if ($this->stack->getRemainingStack() <= 0) {
            $this->setStatus("lose");
            $this->out_of_game = true;
            return false;
        }

        return true;
    }

    private function setBetType()
    {
        if ($this->strategy::TYPE == "splitter") {
            $array = [
                'red',
                'black',
                'odds',
                'evens',
            ];
            $bet = $array[array_rand($array)];
        } elseif ($this->strategy::TYPE == "standard") {
            $bet = 'straightUp';
        }

        $this->bet_type = $bet;
    }
}
