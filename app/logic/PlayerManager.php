<?php

class PlayerManager
{
    /**
     * @var int player_id
     */
    public $id;

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

    private $rankingLeaguePoints;

    /**
     * @param $player_id int wordpress_user_id
     * @param $rankingleague_id int
     */
    public function __construct($player_id, $rankingleague_id = null)
    {
        $this->id = $player_id;
        $this->rankingleague_id = $rankingleague_id;
    }


    public function getRankingforAllRankingLeagues()
    {
        if ($this->rankingLeaguePoints != null) {
            return $this->rankingLeaguePoints;
        } else {
            global $wpdb;
            $wp = $wpdb->prefix;

            $sql = "SELECT rl.name name, sum( r.points ) points
                  FROM " . $wp . "rankingleagues rl, " . $wp . "series s, " . $wp . "tournaments t,
                       " . $wp . "results r, " . $wp . "teams team, " . $wp . "playersinteam pit
                  WHERE s.rankingleague_id = rl.id
                  AND t.serie_id = s.id
                  AND t.id = r.tournament_id
                  AND r.team_id = team.id
                  AND pit.team_id = team.id
                  AND pit.player_id =" . $this->id. "
                  AND r.points > 0
                  GROUP BY player_id
                  ORDER BY points DESC";
            $this->rankingLeaguePoints = $wpdb->get_results($sql);
            return $this->rankingLeaguePoints;
        }
    }

    /**
     * Returns the rankingpoints for the rankingleague_id that is set on the object, throws and exceptions if not set.
     * If you want the rankingpoints for all the rankingleagues see getRankingforAllRankingLeagues
     * @return int rankingpoints
     * @throws Exception
     */
    public function getRanking()
    {
        if (!$this->ranking == null) {
            return $this->ranking;
        }
        if (empty($this->rankingleague_id)) {
            throw new Exception("rankingleague_id not set");
        }
        if ($this->resultModel == null) {
            $this->resultModel = mvc_model("Result");
        }
        global $wpdb;
        $this->ranking = $this->resultModel->sum('Result.points', array(
            'joins' => array('Team' => array('table' => $wpdb->prefix . 'teams',
                'alias' => 'Team',
                'on' => 'Result.team_id = Team.id'),
                array('table' => $wpdb->prefix . 'playersinteam',
                    'alias' => 'PiT',
                    'on' => 'PiT.team_id = Team.id'),
                array('table' => $wpdb->prefix . 'tournaments',
                    'alias' => 'Tournament',
                    'on' => 'Tournament.id = Result.tournament_id'),
                array('table' => $wpdb->prefix . 'series',
                    'alias' => 'Serie',
                    'on' => 'Serie.id = Tournament.serie_id'),
                array('table' => $wpdb->prefix . 'rankingleagues',
                    'alias' => 'Rankingleague',
                    'on' => 'Rankingleague.id = Serie.rankingleague_id')),
            'conditions' => array(
                'PiT.player_id' => $this->id,
                'Rankingleague.id' => $this->rankingleague_id,
            )));

        if ($this->ranking == null) {
            $this->ranking = 0;
        }
        return $this->ranking;
    }

    public function results()
    {
        if ($this->resultModel == null) {
            $this->resultModel = mvc_model("Result");
        }
        global $wpdb;
        $results = $this->resultModel->find(array(
            'joins' => array('Team' => array('table' => $wpdb->prefix . 'teams',
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
        foreach ($results as $result):
            if ($result->player1_id == $this->id):
                $result->partner == new PlayerManager($result->player2_id); else:
                $result->partner == new PlayerManager($result->player1_id);
            endif;
        endforeach;
        return $result;
    }

    public function __get($name)
    {
        if ($name == "user") {
            return get_user_by('id', $this->id);
        }
    }

}
