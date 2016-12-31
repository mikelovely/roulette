<?php

namespace Roulette\Roulette;

class Wheel
{
    public static $number = [
        0 => ['colour' => 'green', 'value' => 0],
        1 => ['colour' => 'red', 'value' => 1],
        2 => ['colour' => 'black', 'value' => 2],
        3 => ['colour' => 'red', 'value' => 3],
        4 => ['colour' => 'black', 'value' => 4],
        5 => ['colour' => 'red', 'value' => 5],
        6 => ['colour' => 'black', 'value' => 6],
        7 => ['colour' => 'red', 'value' => 7],
        8 => ['colour' => 'black', 'value' => 8],
        9 => ['colour' => 'red', 'value' => 9],
        10 => ['colour' => 'black', 'value' => 10],
        11 => ['colour' => 'black', 'value' => 11],
        12 => ['colour' => 'red', 'value' => 12],
        13 => ['colour' => 'black', 'value' => 13],
        14 => ['colour' => 'red', 'value' => 14],
        15 => ['colour' => 'black', 'value' => 15],
        16 => ['colour' => 'red', 'value' => 16],
        17 => ['colour' => 'black', 'value' => 17],
        18 => ['colour' => 'red', 'value' => 18],
        19 => ['colour' => 'red', 'value' => 19],
        20 => ['colour' => 'black', 'value' => 20],
        21 => ['colour' => 'red', 'value' => 21],
        22 => ['colour' => 'black', 'value' => 22],
        23 => ['colour' => 'red', 'value' => 23],
        24 => ['colour' => 'black', 'value' => 24],
        25 => ['colour' => 'red', 'value' => 25],
        26 => ['colour' => 'black', 'value' => 26],
        27 => ['colour' => 'red', 'value' => 27],
        28 => ['colour' => 'black', 'value' => 28],
        29 => ['colour' => 'black', 'value' => 29],
        30 => ['colour' => 'red', 'value' => 30],
        31 => ['colour' => 'black', 'value' => 31],
        32 => ['colour' => 'red', 'value' => 32],
        33 => ['colour' => 'black', 'value' => 33],
        34 => ['colour' => 'red', 'value' => 34],
        35 => ['colour' => 'black', 'value' => 35],
        36 => ['colour' => 'red', 'value' => 36],
    ];

    public static function getNumber()
    {
        $result = self::$number[array_rand(self::$number)];
        return $result;
    }

    public static function getOddNumbers()
    {
        $numbers = array_filter(self::$number, function($var) {
            return ($var['value'] & 1);
        });

        return array_keys($numbers);
    }

    public static function getEvenNumbers()
    {
        $numbers = array_filter(self::$number, function($var) {
            return (!($var['value'] & 1));
        });

        return array_keys($numbers);
    }

    public static function getRedNumbers()
    {

    }

    public static function getBlackNumbers()
    {
        
    }
}
