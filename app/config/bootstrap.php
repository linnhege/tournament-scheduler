<?php
MvcConfiguration::set(array(
    'Debug' => false
));


MvcConfiguration::append(array(
    'AdminPages' => array(
        'tournaments' => array(
            'add' => array('capability' => 'delete_others_pages'),
            'edit'=> array('capability' => 'delete_others_pages'),
            'results' => array('capability' => 'delete_others_pages'),
            'capability' => 'delete_others_pages' ),
        'teams' => array('hide_menu' => true),
        'matches' => array('hide_menu' => true),
        'results' => array(
            'edit_result' => array('capability' => 'delete_others_pages',
                                'in_menu' => false),
            'delete' => array('capability' => 'delete_others_pages',
                'in_menu' => false),
            'add_team' => array('capability' => 'delete_others_pages',
                'in_menu' => false),
            'save_results',
            'choose_tournament_to_edit',
            'capability' => 'delete_others_pages'
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

add_action('mvc_admin_init', 'tournament_scheduler_on_mvc_admin_init');
add_action('mvc_public_init', 'tournament_scheduler_on_mvc_public_init');

function tournament_scheduler_on_mvc_admin_init($options) {
    wp_register_style('mvc-style_tournament-scheduler-admin', mvc_css_url('tournament-scheduler', 'admin'));
    wp_enqueue_style('mvc-style_tournament-scheduler-admin');
}

function tournament_scheduler_on_mvc_public_init($options) {
    wp_register_style('mvc-style_tournament-scheduler-public', mvc_css_url('tournament-scheduler', 'tournament-scheduler'));
    wp_enqueue_style('mvc-style_tournament-scheduler-public');
}