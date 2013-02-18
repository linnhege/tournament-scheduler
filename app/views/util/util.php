<?php


function display_team($team) {
    return display_tournament_user($team->getUser1()) . " - " . display_tournament_user($team->getUser2());
}

function display_team_with_seeding($team) {
    return display_tournament_user($team->getUser1()) . " - " . display_tournament_user($team->getUser2()
        . " (" . $team->getRanking() . ")");
}

function display_tournament_user($user) {
    return "<a href=\"". site_url() . "/player/" .$user->id . "\">" . $user->display_name . "</a>";
}
