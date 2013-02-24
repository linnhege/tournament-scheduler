<?php
MvcConfiguration::set(array(
    'Debug' => false
));


MvcConfiguration::append(array(
    'AdminPages' => array(
        'tournaments' => array(
            'add',
            'edit',
            'results'

        ),
        'venues' => array('hide_menu' => true),
        'teams' => array('hide_menu' => true),
        'matches' => array('hide_menu' => true),
        'results' => array('hide_menu' => true)
    )
));

include_once( __DIR__ . "/../logic/PlayerManager.php");
include_once( __DIR__ . "/../logic/TournamentResultManager.php");
include_once( __DIR__ . "/../logic/SignupValidator.php");
include_once( __DIR__ . "/../logic/TeamManager.php");
include_once( __DIR__ . "/../logic/TournamentManager.php");
include_once( __DIR__ . "/../logic/TournamentTeamManager.php");
include_once( __DIR__ . "/../logic/RankingManager.php");
include_once( __DIR__ . "/../logic/PlayersInTeam.php");
include_once( __DIR__ . "/../views/util/util.php");

