<?php

class TournamentTeamManager
{
    private $tournament;
    private $team_model;
    private $teams = array();

    /**
     * @param $tournament Tournament that inherits from MvcModel
     */
    public function __construct($tournament)
    {
        $this->tournament = $tournament;
        $this->team_model = mvc_model('Team');
    }

    /**
     * @return array of player ids
     */
    public function signupPlayers()
    {
        $signedupPlayers = array();
        foreach ($this->getTeams() as $team):
            $signedupPlayers[] = $team->player_id1;
            $signedupPlayers[] = $team->player_id2;
        endforeach;
        return $signedupPlayers;
    }

    /**
     * @return TeamManager[] array of teams arranged by ranking
     */
    public function seedingList()
    {
        $playersAsTeam = array();
        foreach ($this->getTeams() as $team):
            $playersAsTeam[] = $team;
        endforeach;

        return $playersAsTeam;
    }

    /**
     * @return TeamManager[] array of teams
     */
    private function getTeams()
    {
        if ($this->teams != null) {
            return $this->teams;
        } else {
            $this->teams = array();
            if(!empty($this->tournament->results)):
                foreach ($this->tournament->results as $result):
                    $this->teams[] = TeamManager::constructTeamByTeamId($result->team_id);
                endforeach;
            endif;
            return $this->teams;
        }
    }
}

