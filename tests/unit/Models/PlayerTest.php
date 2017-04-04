<?php

use PHPUnit\Framework\TestCase;

use Roulette\Players\Player;
use Roulette\Players\Stack;

class PlayerTest extends TestCase
{
    protected $none;
    protected $cautious;

    public function __construct()
    {
        $this->none = new \Roulette\Strategies\None;
        $this->cautious = new \Roulette\Styles\Cautious;
    }

    /** @test */
    public function that_player_is_active_whilst_they_still_have_money()
    {
        $player = new Player($this->none, new Stack(20, $this->cautious), $this->cautious);

        $this->assertTrue($player->isActive());
    }

    /** @test */
    public function that_player_is_not_active_when_they_have_no_more_money_to_play_with()
    {
        $player = new Player($this->none, new Stack(100, $this->cautious), $this->cautious);

        $player->stack->addToRemainingStack(1000);

        $this->assertFalse($player->isActive());
    }
}
