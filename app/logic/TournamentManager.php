<?php

class TournamentManager
{
    /**
     * @var Tournament
     */
    private $tournament;

    public $usersAlreadySignup = false;
    private $signedupPlayers = array();
    private $availablePlayers = null;
    private $currentUserId;
    private $users;

    /**
     * @var TournamentTeamManager
     */
    private $tournamentTeamManager;


    public function __construct($tournament, $currentUserId, $users)
    {
        $this->tournament = $tournament;
        $this->users = $users;
        $this->currentUserId = $currentUserId;
    }

    /**
     * @return array List of users.
     */
    public function availablePlayers()
    {
        if (!is_null($this->availablePlayers)) {
            return $this->availablePlayers;
        }
        $excludeList = $this->signupPlayers();
        $excludeList[] = $this->currentUserId;
        $this->availablePlayers = $this->removeUsers($this->users, $excludeList);

        $options = array();
        foreach($this->availablePlayers as $player) {
            $options[$player->ID] = $player->display_name;
        }
        $this->availablePlayers = $options;
        return $options;
    }

    /**
     * @return array of player ids
     */
    public function signupPlayers()
    {
        if($this->tournamentTeamManager == null) {
            $this->tournamentTeamManager = new TournamentTeamManager($this);
        }
        return $this->tournamentTeamManager->signupPlayers();
    }

    /**
     * @return TeamManager[]
     */
    public function seedingList() {
        if($this->tournamentTeamManager == null) {
            $this->tournamentTeamManager = new TournamentTeamManager($this->tournament);
        }
        $teamManagerArray =$this->tournamentTeamManager->seedingList();

        function seeding_sort($a, $b)
        {
            if ($a->getRanking() == $b->getRanking()) {
                return 0;
            }
            return ($a->getRanking() < $b->getRanking()) ? -1 : 1;
        }

        usort($teamManagerArray, 'seeding_sort');
        $reversedTeamManagerArray = array_reverse($teamManagerArray);
        return $reversedTeamManagerArray;
    }


    /**
     * @return bool
     */
    public function isCurrentUserSignedUp()
    {
        return in_array($this->currentUserId, $this->signupPlayers());
    }

    private function removeUsers($users, $excludeUserArray)
    {
        $cleaned_users = array();
        foreach ($users as $user):
            if(!in_array($user->ID, $excludeUserArray)):
                $cleaned_users[] = $user;
            endif;
        endforeach;
        return $cleaned_users;

    }

    public function getResultList()
    {

        $resultManager = new TournamentResultManager($this->tournament->__id);
        $resultList = $resultManager->getResultList();
        foreach($resultList as $result):
            $result->team = TeamManager::constructTeamByTeamId($result->team_id, $this->getRankingLeagueId());
        endforeach;
        return $resultList;
    }

    /**
     * @return int returns the rankingleague_id for this tournament
     */
    public function getRankingLeagueId() {
        global $wpdb;
        $sql = "Select s.rankingleague_id from " . $wpdb->prefix . "series s, " . $wpdb->prefix . "tournaments t
        where t.id =".  $this->tournament->__id . "
        and t.serie_id = s.id";
        $result = $wpdb->get_results($sql);
        return $result[0]->rankingleague_id;


    }

    /**
     * @return Tournament
     */
    public function tournament() {
        return $this->tournament;
    }

    /**
     * @return bool
     */
    public function canUserSignup() {
        //TODO: Trigger this on signup also, not just view part
        global $wpdb;
        $sql = "select
                  (Select count(*) from ". $wpdb->prefix . "results r where r.tournament_id = ". $this->tournament->__id .") pameldte_lag,
                  (Select t.maximum_teams from ". $wpdb->prefix . "tournaments t where t.id = ".$this->tournament->__id.") max
                  from dual";

        $result = $wpdb->get_results($sql);
        $pameldte_lag = $result[0]->pameldte_lag;
        $max = $result[0]->max;
        if($max != 0 && $pameldte_lag >= $max):
            return false;
        else:
            return true;
        endif;
    }
}
