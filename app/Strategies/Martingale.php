<?php

namespace Roulette\Strategies;

class Martingale
{
    private $name;

    public function __construct()
    {
        $this->name = 'martingale';
    }

    public function getName()
    {
        return $this->name;
    }
}