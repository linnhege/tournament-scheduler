<?php

class SeedingPlayer
{
    /**
     * @var int
     */
    public $points;
    /**
     * @var wordpress_user
     */
    public  $player;

    public function __construct($result) {
        $this->player = get_userdata($result->player_id);
        $this->points = $result->points;
    }
}
