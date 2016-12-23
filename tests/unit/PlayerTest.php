<?php

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    protected $player;

    public function setUp()
    {
        $this->player = new \Roulette\Models\Player;
    }

    /** @test */
    public function that_player_is_not_active_until_they_stake_themselves()
    {
        $this->assertFalse($this->player->isActive());

        $this->player->setStake(10);
        $this->assertTrue($this->player->isActive());
    }

    /** @test */
    public function that_player_is_active_whilst_they_still_have_money()
    {
        $this->player->setStake(10);
        $this->assertTrue($this->player->isActive());
        $this->player->updateStake(-5);
        $this->assertTrue($this->player->isActive());
    }

    /** @test */
    public function that_player_is_not_active_when_they_have_no_more_money_to_play_with()
    {
        $this->player->setStake(10);
        $this->player->updateStake(-5);
        $this->player->updateStake(-5);
        $this->assertFalse($this->player->isActive());
    }

    /** @test */
    public function strategy_is_set_for_player()
    {
        $this->player->setStrategy('basic');
        $this->assertInstanceOf(Roulette\Models\Strategies\Basic::class, $this->player->getStrategy());
    }
}
