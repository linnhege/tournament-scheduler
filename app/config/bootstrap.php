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
        'results' => array(
            'edit_result',
            'save_results',
            'choose_tournament_to_edit'
        )
    )
));

include_once( dirname(__FILE__) . "/../logic/PlayerManager.php");
include_once( dirname(__FILE__) . "/../logic/TournamentResultManager.php");
include_once( dirname(__FILE__) . "/../logic/SignupValidator.php");
include_once( dirname(__FILE__) . "/../logic/TeamManager.php");
include_once( dirname(__FILE__) . "/../logic/TournamentManager.php");
include_once( dirname(__FILE__) . "/../logic/TournamentTeamManager.php");
include_once( dirname(__FILE__) . "/../logic/SeedingManager.php");
include_once( dirname(__FILE__) . "/../logic/SeedingPlayerList.php");
include_once( dirname(__FILE__) . "/../logic/SeedingPlayer.php");
include_once( dirname(__FILE__) . "/../logic/PlayersInTeam.php");
include_once( dirname(__FILE__) . "/../views/util/util.php");

