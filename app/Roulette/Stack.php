<?php

namespace Roulette\Roulette;

class Stack
{
    private $initial_stack;
    private $remaining_stack;
    private $style;

    public function __construct($amount, $style)
    {
        $this->initial_stack = $amount;
        $this->remaining_stack = $amount;
        $this->style = $style;
    }

    public function getInitialStack()
    {
        return $this->initial_stack;
    }

    public function getRemainingStack()
    {
        return $this->remaining_stack;
    }

    public function getAmount()
    {
        if (get_class($this->style) == "Roulette\\Styles\\Aggressive") {
            $amount = (float) round(($this->initial_stack / 100) * rand(25, 40));
        } elseif (get_class($this->style) == "Roulette\\Styles\\Cautious") {
            $amount = (float) round(($this->initial_stack / 100) * rand(5, 20));
        }

        if ($amount > $this->getRemainingStack()) {
            $amount = $this->getRemainingStack();
        }

        $this->updateRemainingStack($amount);

        return $amount;
    }

    public function addToRemainingStack($amount)
    {
        $this->remaining_stack = ($this->remaining_stack + $amount);
    }

    public function getDoubleAmount($amount)
    {
        $amount_doubled = $amount * 2;
        
        if ($amount_doubled > $this->getRemainingStack()) {
            $amount_doubled = $this->getRemainingStack();
        }

        $this->updateRemainingStack($amount_doubled);

        return $amount_doubled;
    }

    private function updateRemainingStack($amount)
    {
        $this->remaining_stack = ($this->remaining_stack - $amount);
    }
}
