<h3>Meld på lag:</h3>
<?php

if ($isUserSignedup) {
    $this->render_view('tournaments/signup/_signup_registered', array('locals' =>
    array('tournament' => $tournament,
        'current_user' => $current_user)));

}elseif(!$canUserSignup) {
    $this->render_view('tournaments/signup/_signup_to_many_teams');
}
elseif ($current_user->ID == 0) {
    $this->render_view('tournaments/signup/_signup_not_logged_in', array('locals' =>
    array('tournament' => $tournament,
        'current_user' => $current_user)));
}
elseif(count($availablePlayers) < 2) {
    $this->render_view('tournaments/signup/_signup_not_enough_people');
} else {
    $this->render_view('tournaments/signup/_signup_not_registered', array('locals' =>
    array('tournament' => $tournament,
        'current_user' => $current_user,
        'adminUrl', $adminUrl,
        'availablePlayers' => $availablePlayers)));
}
?>


