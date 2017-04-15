<?php

use Interop\Container\ContainerInterface;
use Roulette\Library\Adapters\Logger;
use Roulette\Library\Adapters\StreamHandler;

return [
    Logger::class => function (ContainerInterface $c) {
        $logger = new Logger('Simulator');
        $logger->pushHandler(
            // some sort of "project global route path" might be good here
            new StreamHandler('../logs/main.log',
            Logger::INFO)
        );

        return $logger;
    }
];
