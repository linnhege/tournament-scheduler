<?php
MvcConfiguration::set(array(
    'Debug' => false
));

include_once( __DIR__ . "/../logic/PlayerManager.php");
include_once( __DIR__ . "/../logic/TournamentResultManager.php");
include_once( __DIR__ . "/../logic/SignupValidator.php");
include_once( __DIR__ . "/../logic/TeamManager.php");
include_once( __DIR__ . "/../logic/TournamentManager.php");
include_once( __DIR__ . "/../logic/TournamentTeamManager.php");
include_once( __DIR__ . "/../logic/RankingManager.php");

include_once( __DIR__ . "/../views/util/util.php");

