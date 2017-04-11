<?php

namespace Roulette\Console\Commands;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Roulette\Console\Command;
use Roulette\Controllers\SimulationController;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SimulateCommand extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $command = 'run:simulation';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Runs the Simulation';

    /**
     * Handle the command.
     *
     * @param  InputInterface $input
     * @param  OutputInterface $output
     *
     * @return void
     */
    public function handle(InputInterface $input, OutputInterface $output)
    {
        $logger = new Logger('Simulator');

        $logger->pushHandler(
            new StreamHandler('./logs/main.log',
            Logger::INFO)
        );

        $simulation = new SimulationController($logger);

        $simulation->index();
    }

    /**
     * Command arguments
     *
     * @return array
     */
    protected function arguments()
    {
        return [];
    }

    /**
     * Command options.
     *
     * @return array
     */
    protected function options()
    {
        return [];
    }
}
