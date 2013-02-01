<?php

class TournamentManager
{
    private $tournament;
    public $usersAlreadySignup = false;
    private $signedupPlayers = array();
    private $availablePlayers = null;
    private $currentUserId;
    private $users;


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
        if ($this->availablePlayers != null) {
            return $this->availablePlayers;
        }
        $excludeList = $this->signupPlayers();
        $excludeList[] = $this->currentUserId;
        $this->availablePlayers = $this->removeUsers($this->users, $excludeList);
        return $this->availablePlayers;
    }

    public function signupPlayers()
    {
        if (!$this->signedupPlayers == null) {
            return $this->signedupPlayers;
        } else {
            $this->signedupPlayers = array();

            foreach ($this->tournament->results as $result) {
                $this->signedupPlayers[] = $result->teams->player1_id;
                $this->signedupPlayers[] = $result->teams->player2_id;
            }
            return $this->signedupPlayers;
        }
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
}
