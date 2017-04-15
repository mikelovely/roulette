<?php

namespace Roulette\Players;

trait Status
{
    public function status($status)
    {
        switch ($status) {
            case "final.win":
                $status = "{$this->getName()} has won. Initial buy-in: {$this->stack->getInitialStack()}. Final amount: {$this->stack->getRemainingStack()}";
                break;
            case "final.lose":
                $status = "{$this->getName()} has lost. Player lost: {$this->stack->getInitialStack()}";
                break;
        }

        $this->status = $status;

        $this->logger->info($status);
    }

    public function getStatus()
    {
        return $this->status;
    }
}
