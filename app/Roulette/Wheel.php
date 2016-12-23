<?php

namespace Roulette\Roulette;

class Wheel
{
    public static $number = [
        0 => ['colour' => 'green'],
        1 => ['colour' => 'red'],
        2 => ['colour' => 'black'],
        3 => ['colour' => 'red'],
        4 => ['colour' => 'black'],
        5 => ['colour' => 'red'],
        6 => ['colour' => 'black'],
        7 => ['colour' => 'red'],
        8 => ['colour' => 'black'],
        9 => ['colour' => 'red'],
        10 => ['colour' => 'black'],
        11 => ['colour' => 'black'],
        12 => ['colour' => 'red'],
        13 => ['colour' => 'black'],
        14 => ['colour' => 'red'],
        15 => ['colour' => 'black'],
        16 => ['colour' => 'red'],
        17 => ['colour' => 'black'],
        18 => ['colour' => 'red'],
        19 => ['colour' => 'red'],
        20 => ['colour' => 'black'],
        21 => ['colour' => 'red'],
        22 => ['colour' => 'black'],
        23 => ['colour' => 'red'],
        24 => ['colour' => 'black'],
        25 => ['colour' => 'red'],
        26 => ['colour' => 'black'],
        27 => ['colour' => 'red'],
        28 => ['colour' => 'black'],
        29 => ['colour' => 'black'],
        30 => ['colour' => 'red'],
        31 => ['colour' => 'black'],
        32 => ['colour' => 'red'],
        33 => ['colour' => 'black'],
        34 => ['colour' => 'red'],
        35 => ['colour' => 'black'],
        36 => ['colour' => 'red'],
    ];

    public function __construct()
    {

    }

    public static function getNumber()
    {
        // return a random number from list of possible roulette outcomes
        return array_rand(self::number);
    }
}
