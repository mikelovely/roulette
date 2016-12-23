<?php

namespace Roulette\Models;

use Roulette\Roulette\Bet;

class Player
{
    private $strategy;
    private $pace;
    private $preference;
    private $bets;
    private $stake;

    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    public function setPace($pace)
    {
        $this->pace = $pace;
    }

    public function setInitialStake()
    {
        $this->stake = $stake;
    }

    public function leaveTable()
    {
        // stop the simulation if not yet out of money.
    }

    public function makeBet($bet)
    {
        $this->bets[$bet];

        Bet::add($bet);
    }

    public function isActive()
    {
        // player is playing if they still have money or if they have not yet walked away.
    }
}
