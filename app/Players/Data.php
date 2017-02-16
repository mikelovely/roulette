<?php

namespace Roulette\Players;

trait Data
{
    public function setInitialVariables() {
        $this->out_of_game = false;
        $this->player_won_on_previous_round = false;
        $this->first_go = true;
    }
}
