<?php

namespace Roulette\Players;

use Roulette\Interfaces\Style;

class Stack
{
    private $initial_stack;
    private $remaining_stack;
    private $style;

    public function __construct($amount, Style $style)
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
        $amount = $this->style->getAmount(
            $this->initial_stack
        );

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

        $this->updateRemainingStack($amount_doubled);

        return $amount_doubled;
    }

    private function updateRemainingStack($amount)
    {
        // player cannot bet more than the amount of chips they have left
        $amt = ($amount > $this->getRemainingStack()) ? $this->getRemainingStack() : $amount;

        $this->remaining_stack = ($this->remaining_stack - $amt);
    }
}
