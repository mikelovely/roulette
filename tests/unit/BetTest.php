<?php

class BetTest extends \PHPUnit_Framework_TestCase
{
    protected $bet;
    protected $amount;

    public function setUp()
    {
        $this->amount = 70;
        $this->bet = new \Roulette\Models\Bet($this->amount);
    }

    /** @test */
    public function that_a_basic_bet_will_use_all_available_amounts_in_betting_spread()
    {
        $value = 0;

        foreach ($this->bet->basic() as $key => $array) {
            $value += $array["coverage"];
        }

        $this->assertEquals($this->amount, $value);
    }
}
