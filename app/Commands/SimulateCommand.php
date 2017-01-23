<?php

namespace Roulette\Commands;

use Roulette\Controllers\SimulationController;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class SimulateCommand extends Command
{
    public function configure()
    {
        $this->setName('run:simulation')
            ->setDescription('Run the simulation.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $sim = new SimulationController;

        $sim->index();
    }
}