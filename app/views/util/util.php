<?php

/**
 * @param $team TeamManager
 * @return string html
 */
function display_team($team) {
    $output = "";
    $i = 1;
    foreach($team->getUsers() as $user):
        if(sizeof($team->getUsers())== $i) {
            $output.= display_tournament_user($user);
        } else {
            $output.= display_tournament_user($user) . " - ";
            $i++;
        }
    endforeach;
    return $output;
}

/**
 * @param $team TeamManager
 * @return string html
 *
 */
function display_team_with_seeding($team) {
    return display_team($team) . " (" . $team->getRanking() . ")";
}

/**
 * @param $user wordpress_user class... or something like that $wp_user
 * @return string html
 */
function display_tournament_user($user) {
    return "<a href=\"". site_url() . "/players/" .$user->id . "\">" . $user->display_name . "</a>";
}

function display_tournament_result($tournament) {
    $mvcTournamentsEditResults = 'mvc_results-edit_result';
    return "<a href=\"".  admin_url("admin.php/?page=$mvcTournamentsEditResults&id=" . $tournament->id) . '">' . $tournament->name . "</a>";
}

function print_a($a) {
    echo "<pre>";
        print_r($a);
    echo "</pre>";

}