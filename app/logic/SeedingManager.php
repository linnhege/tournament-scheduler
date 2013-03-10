<?php

class SeedingManager
{

    private $rankingleague_id;
    /**
     *
     */
    public function __construct($rankingleague_id) {
        $this->teamsModel = mvc_model("Result");
        $this->rankingleague_id = $rankingleague_id;
    }

    /**
     * @return array
     */
    public function getSeedingList() {
        global $wpdb;
        $wp = $wpdb->prefix;

        $sql = "SELECT pit.player_id player_id, sum( r.points ) points
          FROM ".$wp."rankingleagues rl, ".$wp."series s, ".$wp."tournaments t,
               ".$wp."results r, ".$wp."teams team, ".$wp."playersinteam pit
          WHERE s.rankingleague_id = rl.id
          AND t.serie_id = s.id
          AND t.id = r.tournament_id
          AND r.team_id = team.id
          AND pit.team_id = team.id
          AND rl.id =" . $this->rankingleague_id ."
          AND r.points > 0
          GROUP BY player_id
          ORDER BY points DESC";
        $results = $wpdb->get_results($sql);
        $seedingPlayerList = new SeedingPlayerList($results);
        return $seedingPlayerList->seedingList;

    }
}
