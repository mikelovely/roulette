<?php

namespace Roulette\Interfaces;

interface Strategy
{
    public function makeBet(bool $firstGo, int $lastBet);
}