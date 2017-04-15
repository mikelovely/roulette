<?php

namespace Roulette\Console;

class Kernel
{
    protected $commands = [
        \Roulette\Console\Commands\SimulateCommand::class,
    ];

    public function getCommands()
    {
        return array_merge($this->commands);
    }
}
