<?php

namespace Roulette\Controllers;

use Monolog\Logger;

abstract class Controller
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
}
