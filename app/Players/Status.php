<?php

namespace Roulette\Players;

trait Status
{
    public function setStatus($win_or_lose)
    {
        switch ($win_or_lose) {
            case "win":
                $this->logger->info("{$this->getName()} has won. Initial buy-in: {$this->stack->getInitialStack()}. Final amount: {$this->stack->getRemainingStack()}");
                break;
            case "lose":
                $this->logger->info("{$this->getName()} has lost. Player lost: {$this->stack->getInitialStack()}");
                break;
        }
    }

    public function getStatus()
    {
        return $this->status;
    }
}
