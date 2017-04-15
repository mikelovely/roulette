<?php

namespace Roulette\Console;

use Roulette\App;
use Symfony\Component\Console\Application;

class Console extends Application
{
    protected $slim;

    public function __construct(App $slim)
    {
        parent::__construct();
        $this->slim = $slim;
    }

    public function boot(Kernel $kernel)
    {
        foreach ($kernel->getCommands() as $command) {
            $this->add(new $command($this->getSlim()->getContainer()));
        }
    }

    protected function getSlim()
    {
        return $this->slim;
    }
}
