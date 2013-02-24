<?php

/**
 *
 */
class PlayersInTeam
{
    private $wpdb;
    public function __construct($wpdb) {
        $this->wpdb = $wpdb;
    }

    /**
     * @param $teams array team_id's
     * @return array players_id 's in
     */
    public function getPlayersFromTeam($teams) {
        $signedupPlayers = array();
        $sql = "Select distinct player_id from " . $this->wpdb->prefix . "playersinteam where team_id IN (" . implode(",", $teams) . ")";
        $results = $this->wpdb->get_results($sql);
        foreach($results as $result):
            $signedupPlayers[] = $result->player_id;
        endforeach;
        return $signedupPlayers;
    }
}
