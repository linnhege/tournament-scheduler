<?php

class Player
{
    /**
     * @var int
     */
    public  $id;

    private $resultModel;

    /**
     * @var int
     */
    private $ranking;

    /**
     * @param $player_id int wordpress_user_id
     */
    public function __construct($player_id) {
        $this->id = $player_id;
    }

    public function getRanking() {
        if(!$this->ranking == null) {
            return $this->ranking;
        }
        $this->resultModel = mvc_model("Result");

        $this->ranking = $this->resultModel->sum('Result.points', array(
            'joins' => array('Team' => array('table' => 'wp_teams',
                                             'alias' => 'Team',
                                             'on' => 'Result.team_id')),
            'conditions' => array(
                'OR' => array(
                    'Team.player1_id' => $this->id,
                    'Team.player2_id' => $this->id,
                )
            )));

        if($this->ranking == null) {
            $this->ranking = 0;
        }
        return $this->ranking;
    }

}
