<?php

class TournamentSchedulerLoader extends MvcPluginLoader
{

    var $db_version = '0.6';
    var $tables = array();

    function activate()
    {

        // This call needs to be made to activate this app within WP MVC

        $this->activate_app(__FILE__);

        // Perform any databases modifications related to plugin activation here, if necessary

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $tournament_scheduler_db_version = 'tournament_scheduler_db_version';
        $installed_ver = get_option($tournament_scheduler_db_version);
        global $wpdb;

        if ($installed_ver !== $tournament_scheduler_db_version) {
            $sql = "CREATE TABLE {$wpdb->prefix}tournaments (
              id mediumint(9) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
              name tinytext NOT NULL,
              serie_id mediumint(9) NOT NULL,
              date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
              location tinytext NOT NULL,
              details text,
              final_seeding text,
              UNIQUE KEY id (id)
              ) DEFAULT CHARACTER SET utf8;";
            dbDelta($sql);

            $sql = "CREATE TABLE {$wpdb->prefix}series (
                          id mediumint(9) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
                          name tinytext NOT NULL,
                          rankingleague_id mediumint(9) NOT NULL,
                          details text,
                          UNIQUE KEY id (id)
                          ) DEFAULT CHARACTER SET utf8;";
            dbDelta($sql);

            $sql = "CREATE TABLE {$wpdb->prefix}rankingleagues (
                          id mediumint(9) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
                          name tinytext NOT NULL,
                          details text,
                          UNIQUE KEY id (id)
                          ) DEFAULT CHARACTER SET utf8;";
            dbDelta($sql);

            $sql = "CREATE TABLE {$wpdb->prefix}teams (
                          id mediumint(9) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
                          player1_id mediumint(9) NOT NULL,
                          player2_id mediumint(9) NOT NULL,
                          UNIQUE KEY id (id),
                          UNIQUE KEY id (player1_id, player2_id)
                          ) DEFAULT CHARACTER SET utf8;";
            dbDelta($sql);

            $sql = "CREATE TABLE {$wpdb->prefix}matches (
                          id mediumint(9) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
                          tournament_id mediumint(9) NOT NULL,
                          team1_id mediumint(9) NOT NULL,
                          team2_id mediumint(9) NOT NULL,
                          winner_id mediumint(9),
                          team1_sett1 int,
                          team1_sett2 int,
                          team1_sett3 int,
                          team2_sett1 int,
                          team2_sett2 int,
                          team2_sett3 int,
                          walkover boolean default false,
                          walkover_comment text,
                          description text,
                          UNIQUE KEY id (id)
                          ) DEFAULT CHARACTER SET utf8;";
            dbDelta($sql);

            $sql = "CREATE TABLE {$wpdb->prefix}results (
                          id mediumint(9) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
                          tournament_id mediumint(9) NOT NULL,
                          team_id mediumint(9) NOT NULL,
                          points mediumint(9) NOT NULL,
                          place mediumint(9) NOT NULL,
                          comment text,
                          UNIQUE KEY id (id)
                          ) DEFAULT CHARACTER SET utf8;";
            dbDelta($sql);
        }
    }

    function deactivate()
    {

        // This call needs to be made to deactivate this app within WP MVC

        $this->deactivate_app(__FILE__);

        // Perform any databases modifications related to plugin deactivation here, if necessary

    }

}

?>