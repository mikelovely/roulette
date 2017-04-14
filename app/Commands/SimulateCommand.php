<?php

namespace Roulette\Commands;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Roulette\Controllers\SimulationController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SimulateCommand extends Command
{
    public function configure()
    {
        $this->setName('run:simulation')
            ->setDescription('Run the simulation.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = new Logger('Simulator');
        $logger->pushHandler(new StreamHandler('../logs/main.log', Logger::INFO));

        $sim = new SimulationController($logger);

        $sim->index();
    }
}
