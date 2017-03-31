<?php

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    protected $player;
    protected $none;
    protected $cautious;

    public function __construct()
    {
        $this->none = new \Roulette\Strategies\None;
        $this->cautious = new \Roulette\Styles\Cautious;
    }

    public function setUp()
    {
        $this->player = new \Roulette\Players\Player($this->none, 100, $this->cautious);
    }

    /** @test */
    public function that_player_is_active_whilst_they_still_have_money()
    {
        $player = new \Roulette\Players\Player($this->none, 20, $this->cautious);

        $this->assertTrue($player->isActive());
    }

    /** @test */
    public function that_player_is_not_active_when_they_have_no_more_money_to_play_with()
    {
        $player = new \Roulette\Players\Player($this->none, 100, $this->cautious);

        $player->stack->addToRemainingStack(1000);

        $this->assertFalse($player->isActive());
    }
}
