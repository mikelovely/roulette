<?php

namespace Roulette\Strategies;

use Roulette\Traits\Doublable as DoublableTrait;
use Roulette\Interfaces\Doublable as DoublableInterface;

class Martingale implements DoublableInterface
{
    use DoublableTrait;
}