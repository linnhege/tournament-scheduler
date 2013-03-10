<?php

class PlayerManager
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
     * @var int
     */
    private $rankingleague_id;

    private $results;

    /**
     * @param $player_id int wordpress_user_id
     * @param $rankingleague_id int
     */
    public function __construct($player_id, $rankingleague_id) {
        $this->id = $player_id;
        $this->rankingleague_id = $rankingleague_id;
    }

    public function getRanking() {
        if(!$this->ranking == null) {
            return $this->ranking;
        }
        if($this->resultModel== null) {
            $this->resultModel = mvc_model("Result");
        }
        global $wpdb;
        $this->ranking = $this->resultModel->sum('Result.points', array(
            'joins' => array('Team' => array('table' => $wpdb->prefix .'teams',
                                             'alias' => 'Team',
                                             'on' => 'Result.team_id = Team.id'),
                                    array('table' => $wpdb->prefix .'playersinteam',
                                        'alias' => 'PiT',
                                        'on' => 'PiT.team_id = Team.id'),
                                    array('table' => $wpdb->prefix .'tournaments',
                                        'alias' => 'Tournament',
                                        'on' => 'Tournament.id = Result.tournament_id'),
                                    array('table' => $wpdb->prefix .'series',
                                    'alias' => 'Serie',
                                    'on' => 'Serie.id = Tournament.serie_id'),
                                    array('table' => $wpdb->prefix .'rankingleagues',
                                        'alias' => 'Rankingleague',
                                        'on' => 'Rankingleague.id = Serie.rankingleague_id')),
            'conditions' => array(
                    'PiT.player_id' => $this->id,
                    'Rankingleague.id' => $this->rankingleague_id,
            )));

        if($this->ranking == null) {
            $this->ranking = 0;
        }
        return $this->ranking;
    }

    public function results() {
        if($this->resultModel== null) {
            $this->resultModel = mvc_model("Result");
        }
        global $wpdb;
        $results = $this->resultModel->find(array(
            'joins' => array('Team' => array('table' => $wpdb->prefix  . 'teams',
                                'alias' => 'Team',
                                'on' => 'Result.team_id = Team.id'),
                              'Tournament' => array('table')),
            'selects' => array('Team.player1_id', 'Team.player2_id', 'Result.*'),
            'conditions' => array(
                'OR' => array(
                    'Team.player1_id' => $this->id,
                    'Team.player2_id' => $this->id,
                ),
            )));
        foreach($results as $result):
            if($result->player1_id == $this->id):
                $result->partner == new PlayerManager($result->player2_id);
            else:
                $result->partner == new PlayerManager($result->player1_id);
            endif;
        endforeach;
        return $result;
    }

    public function __get($name) {
        if($name == "user") {
            return get_user_by('id', $this->id);
        }
    }

}
