<?php

namespace Roulette\Strategies;

class None
{
    private $name;

    public function __construct()
    {
        $this->name = 'none';
    }

    public function getName()
    {
        return $this->name;
    }
}