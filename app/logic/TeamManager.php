<?php

class TeamManager
{
    private $teamsModel;
    public  $team_id;
    public $players;
    public $team_name;

    private function __construct($team_id) {
        $this->teamsModel = mvc_model("Team");
        $team = $this->teamsModel->find_one_by_id($team_id);
        if($team == null) {
            throw new UnexpectedValueException("The id for Team do not exist:" . $team_id);
        }
        $this->team_id = $team_id;
        $this->team_name = $team->name;

        global $wpdb;
        $results = $wpdb->get_results("Select * from " . $wpdb->prefix . "playersinteam where team_id = " . $team_id);
        $this->players = array();
        foreach($results as  $result):
            $this->players[] = $result->player_id;
        endforeach;
    }

    /**
     * @param $team_id
     * @return TeamManager
     */
    public static function constructTeamByTeamId($team_id) {
        return new TeamManager($team_id);
    }

    /**
     * @param $players
     * @return TeamManager
     */
    public  static function constructTeamByPlayerIds(array $players) {
        $teamsModel = mvc_model("Team");

        //TODO: Same query twice. Could be fixed if performance issues
        if(!self::teamExist($players)) {
            $team_id = self::getTeamId($players);
        } else {
            $team_id = self::createTeam($players, $teamsModel);
        }
        return new TeamManager($team_id);
    }

    private static function teamExist($players)
    {
        global $wpdb;
        $sql = self::createTeamExistSql($players);
        $wpdb->get_results("$sql");
        $count = $wpdb->num_rows;
        return ($count != 0);
    }

    private static function getTeamId($players)
    {
        global $wpdb;
        $sql = self::createTeamExistSql($players);
        $result = $wpdb->get_results("$sql");
        return $result->team_id;
    }

    public  static function createTeam($players, $teamsModel)
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $team = array(
            'name' => implode(",", $players)
        );
        $teamsModel->create($team);
        $id = $teamsModel->insert_id;
        //TODO: Why do the num_rows say 2 on the query below??
        $expected_affected_rows = 2;
        $unexpected_problems = false;
        foreach($players as $player):
            $sql = "INSERT INTO ".$prefix."playersinteam(team_id, player_id) VALUES ($id, $player)";
            $result = $wpdb->query("$sql");
            $affected_rows = $wpdb->num_rows;
            echo "affected_rows: " . $affected_rows;
            if($affected_rows != $expected_affected_rows):
                $unexpected_problems  = true;
            endif;
        endforeach;
        if($unexpected_problems) {
            throw new DomainException("Problems creating teams...
                            The creation of the team could be in a error stat");
        }
        return $id;
    }

    /**
     * @return int
     */
    public  function getRanking() {
        $sum = 0;
        foreach($this->players as $player_id):
            $player = new PlayerManager($player_id);
            $sum += $player->getRanking();
        endforeach;
        return $sum;
    }

    /**
     * @return PlayerManager[]
     */
    public function getPlayers() {
        $players = array();
        foreach($this->players as $player_id):
            $players[] = new PlayerManager($player_id);
        endforeach;
        return $players;
    }

    public function getUsers() {
        foreach($this->players as $player_id):
            $users[] = get_user_by('id', $player_id);

        endforeach;
        return $users;
    }


    /**
     * @param $players array of ids
     */
    private static function createTeamExistSql($players)
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $sql = "SELECT p1.team_id  FROM ";
        foreach($players as $key => $player):
            $number = $key +1;
            if($number == count($players)) {
                $sql.= $prefix."playersinteam p$number ";
            } else {
                $sql.= $prefix."playersinteam p$number, ";
            }
        endforeach;
        $sql.="WHERE ";
        foreach($players as $key => $player):
            $number = $key+1;
            if($number == 1):
                $sql.= "p$number.player_id = $player ";
            elseif($number == count($players)):
                $sql.= "AND p$number.player_id = $player, ";
            else:
                $sql.= "AND p$number.player_id = $player";
            endif;
        endforeach;
        foreach($players as $key => $player):
            $number = $key+1;
            $oneInFront = $number +1;
            if($number == 1):
                $sql.= "p$number.team_id = p$oneInFront.team_id ";
                if(count($players) == 2):
                    $sql.=", ";
                endif;
            elseif($oneInFront == count($players)):
                $sql.= "AND p$number.team_id = p$oneInFront.team_id ";
            elseif($number == count($players)):
                $sql.= "";
            else:
                $sql.= "AND p$number.team_id = p$oneInFront.team_id, ";
            endif;
        endforeach;
        $sql.= "AND (p1.team_id) NOT IN
            (select distinct sub.team_id from wp_playersinteam sub
                WHERE sub.player_id not in (";
        foreach($players as $key => $player):
            $sql.= $player;
            if(count($players) != $key +1):
                $sql.=",";
            endif;
        endforeach;
        $sql.=")";
        echo $sql;
        exit;
        return $sql;
    }

}
