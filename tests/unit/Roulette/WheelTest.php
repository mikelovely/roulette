<?php

use \Roulette\Roulette\Wheel;

class WheelTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function that_correct_neighbours_array_returns()
    {
        $expected = [
            0 => ['colour' => 'red', 'value' => 3],
            1 => ['colour' => 'black', 'value' => 26],
            2 => ['colour' => 'green', 'value' => 0],
            3 => ['colour' => 'red', 'value' => 32],
            4 => ['colour' => 'black', 'value' => 15],
        ];
        
        $actual = Wheel::getNeighbours(0);

        $this->assertEquals($expected, $actual);
    }
}