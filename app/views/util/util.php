<?php


function display_team($team) {
    $output = "";
    $i = 0;
    foreach($team->getUsers() as $user):
        if(sizeof($team->getUsers())== $i+1) {
            $output.= display_tournament_user($user);
        } else {
            $output.= display_tournament_user($user) . " - ";
        }
    endforeach;
    return $output;
}

function display_team_with_seeding($team) {
    return display_team($team) . " (" . $team->getRanking() . ")";
}

function display_tournament_user($user) {
    return "<a href=\"". site_url() . "/players/" .$user->id . "\">" . $user->display_name . "</a>";
}
