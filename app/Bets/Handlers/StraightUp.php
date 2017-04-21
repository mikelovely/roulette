<?php

namespace Roulette\Bets\Handlers;

use Roulette\Library\Adapters\Logger;
use Roulette\Players\Player;

class StraightUp
{
    private $spin_result;
    private $player;
    private $bet_data;
    private $logger;

    public function __construct($spin_result, Player $player, $bet_data, Logger $logger)
    {
        $this->spin_result = $spin_result;
        $this->player = $player;
        $this->bet_data = $bet_data;
        $this->logger = $logger;
    }

    public function handle()
    {
        if ($this->spin_result['value'] == $this->bet_data['number']) {
            $this->logger->info("{$this->player->getName()} wins {$this->bet_data['potential_win']}.");
            $this->player->stack->addToRemainingStack($this->bet_data['potential_win']);
            return true;
        }

        return false;
    }
}
