<?php

namespace Roulette\Bets\Handlers;

use Roulette\Library\Adapters\Logger;
use Roulette\Players\Player;

class EvenMoney
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
        if (in_array($this->spin_result['value'], $this->player->current_bet->winningNumbers())) {
            $this->logger->info("{$this->player->getName()} wins {$this->bet_data['potential_win']}.");
            $this->player->stack->addToRemainingStack($this->bet_data['potential_win']);
            return true;
        }

        return false;
    }
}
