<?php
MvcConfiguration::set(array(
    'Debug' => false
));

include_once( __DIR__ . "/../logic/Player.php");
include_once( __DIR__ . "/../logic/ResultManager.php");
include_once( __DIR__ . "/../logic/SignupValidator.php");
include_once( __DIR__ . "/../logic/TeamManager.php");
include_once( __DIR__ . "/../logic/TournamentManager.php");
include_once( __DIR__ . "/../logic/TournamentTeamManager.php");


include_once( __DIR__ . "/../views/util/util.php");

