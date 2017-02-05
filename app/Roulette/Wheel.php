<?php

namespace Roulette\Roulette;

class Wheel
{
    public static $number = [
        0 => ['colour' => 'green', 'value' => 0],
        1 => ['colour' => 'red', 'value' => 32],
        2 => ['colour' => 'black', 'value' => 15],
        3 => ['colour' => 'red', 'value' => 19],
        4 => ['colour' => 'black', 'value' => 4],
        5 => ['colour' => 'red', 'value' => 21],
        6 => ['colour' => 'black', 'value' => 2],
        7 => ['colour' => 'red', 'value' => 25],
        8 => ['colour' => 'black', 'value' => 17],
        9 => ['colour' => 'red', 'value' => 34],
        10 => ['colour' => 'black', 'value' => 6],
        11 => ['colour' => 'red', 'value' => 27],
        12 => ['colour' => 'black', 'value' => 13],
        13 => ['colour' => 'red', 'value' => 36],
        14 => ['colour' => 'black', 'value' => 11],
        15 => ['colour' => 'red', 'value' => 30],
        16 => ['colour' => 'black', 'value' => 8],
        17 => ['colour' => 'red', 'value' => 23],
        18 => ['colour' => 'black', 'value' => 10],
        19 => ['colour' => 'red', 'value' => 5],
        20 => ['colour' => 'black', 'value' => 24],
        21 => ['colour' => 'red', 'value' => 16],
        22 => ['colour' => 'black', 'value' => 33],
        23 => ['colour' => 'red', 'value' => 1],
        24 => ['colour' => 'black', 'value' => 20],
        25 => ['colour' => 'red', 'value' => 14],
        26 => ['colour' => 'black', 'value' => 31],
        27 => ['colour' => 'red', 'value' => 9],
        28 => ['colour' => 'black', 'value' => 22],
        29 => ['colour' => 'red', 'value' => 18],
        30 => ['colour' => 'black', 'value' => 29],
        31 => ['colour' => 'red', 'value' => 7],
        32 => ['colour' => 'black', 'value' => 28],
        33 => ['colour' => 'red', 'value' => 12],
        34 => ['colour' => 'black', 'value' => 35],
        35 => ['colour' => 'red', 'value' => 3],
        36 => ['colour' => 'black', 'value' => 26],
    ];

    public static function getNumber()
    {
        return self::$number[array_rand(self::$number)];
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
        $numbers = array_filter(self::$number, function($var) {
            return ($var['colour'] == "red");
        });

        return array_keys($numbers);
    }

    public static function getBlackNumbers()
    {
        $numbers = array_filter(self::$number, function($var) {
            return ($var['colour'] == "black");
        });

        return array_keys($numbers);
    }

    public static function getNeighbours($number)
    {
        // get the key
        $key = array_search($number, array_column(self::$number, 'value'));

        $output = []
        $output[] = $numbers[$key]->value;

        switch ($key) {
            case 0:
                $output[] = $numbers[36]
                $output[] = $numbers[35]
                $output[] = $numbers[$key+1]
                $output[] = $numbers[$key+2]
            case 1:
                $output[] = $numbers[36]
                $output[] = $numbers[0]
                $output[] = $numbers[$key+1]
                $output[] = $numbers[$key+2]
            case 35:

            case 35:

            default:
            $output[] = $numbers[$key-2]->value
                $output[] = $numbers[$key-2]->value
                $output[] = $numbers[$key+1]->value
                $output[] = $numbers[$key+2]->value
        }
        if $key < 2 {
            if ($key == 1)
            $key , $key +1, $key +2, 
        }

        // determine range of keys
        $range = range($key - 2, $key + 2);
        $output = [];

        foreach ($range as $k => $item) {
            // keep the values inside the range
            if ($item < 0) {
                $item = 37 + $item;
            } else if ($item > 36) {
                $item = $item - 37;
            }
            // add section to the output
            $output[] = self::$number[$item];
        }

        return $output;
    }
}
