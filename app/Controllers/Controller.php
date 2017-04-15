<?php

namespace Roulette\Controllers;

use Roulette\Library\Adapters\Logger;

abstract class Controller
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
}
