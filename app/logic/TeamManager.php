<?php

class TeamManager
{
    private $teamsModel;
    private $team_id;
    public  $player_id1;
    public $player_id2;

    private function __construct($team_id) {
        $this->teamsModel = mvc_model("Team");
        $team = $this->teamsModel->find_one_by_id($team_id);
        if($team == null) {
            throw new UnexpectedValueException("The id for Team do not exist:" . $team_id);
        }
        $this->player_id1 = $team->player1_id;
        $this->player_id2 = $team->player2_id;
        $this->team_id = $team_id;
    }

    /**
     * @param $team_id
     * @return TeamManager
     */
    public static function constructTeamByTeamId($team_id) {
        return new TeamManager($team_id);
    }

    /**
     * @param $player_id1
     * @param $player_id2
     * @return TeamManager
     */
    public  static function constructTeamByPlayerIds($player_id1, $player_id2) {
        $teamsModel = mvc_model("Team");

        if($player_id1 < $player_id2) {
            $id1 = $player_id1;
            $id2 = $player_id2;
        } else {
            $id1 = $player_id2;
            $id2 = $player_id1;
        }
        if(!self::teamExist($id1, $id2, $teamsModel)) {
            $team_id = self::getTeamId($id1, $id2, $teamsModel);
        } else {
            $team_id = self::createTeam($id1, $id2, $teamsModel);
        }
        return new TeamManager($team_id);
    }

    private static function teamExist($id1, $id2, $teamsModel)
    {
        $count = $teamsModel->count(array('conditions' => array(
            'player1_id' => $id1,
            'player2_id' => $id2,
        )));
        return ($count != 0);
    }

    private static function getTeamId($id1, $id2, $teamsModel)
    {
        $team = $teamsModel->find_one(array('conditions' => array(
            'player1_id' => $id1,
            'player2_id' => $id2,
        )));
        return $team->id;
    }

    public  static function createTeam($id1, $id2, $teamsModel)
    {
        $team = array(
            'player1_id' => $id1,
            'player2_id' => $id2,
        );
        $teamsModel->create($team);
        $id = $teamsModel->insert_id;
        return $id;
    }

    /**
     * @return int
     */
    public  function getRanking() {
        $player1 = new PlayerManager($this->player_id1);
        $player2 = new PlayerManager($this->player_id2);
        return $player1->getRanking() + $player2->getRanking();
    }

    /**
     * @return Player
     */
    public function getPlayer1() {
        return new PlayerManager($this->player_id1);
    }

    /**
     * @return Player
     */
    public function getPlayer2() {
        return new PlayerManager($this->player_id2);
    }

    public function getUser1() {
        return get_user_by('id', $this->player_id1);
    }

    public function getUser2() {
        return get_user_by('id', $this->player_id2);
    }
}
