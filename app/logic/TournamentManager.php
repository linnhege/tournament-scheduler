<?php

class TournamentManager
{
    private $tournament;
    public $usersAlreadySignup = false;
    private $signedupPlayers = array();
    private $availablePlayers = null;
    private $currentUserId;
    private $users;
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
        if (is_null($this->availablePlayers)) {
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
            $this->tournamentTeamManager = new TournamentTeamManager($this->tournament);
        }
        return $this->tournamentTeamManager->signupPlayers();
    }

    /**
     * @return array returns an array of arrays that contains 2 elements, the id's the player on the team.
     */
    public function seedingList() {
        if($this->tournamentTeamManager == null) {
            $this->tournamentTeamManager = new TournamentTeamManager($this->tournament);
        }
        return $this->tournamentTeamManager->seedingList();
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
        $resultManager = new ResultManager($this->tournament->id);
        $resultList = $resultManager->getResultList();
        foreach($resultList as $result):
            $result->team = TeamManager::constructTeamByTeamId($result->team_id);
        endforeach;
        return $resultList;
    }
}
