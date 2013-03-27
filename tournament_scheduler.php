<?php
/*
Plugin Name: Tournament Scheduler
Plugin URI:
Description: a simple tournament scheduler that lets users of your site signup for beach volleyball tournaments.
Handles a series of tournament with that automatically calculates the seeding based on the result of past tournaments
Author: Sindre Øye Svendby
Version: 0.5.4.2
Author URI:
*/

//Not triggered on update since 3.1
register_activation_hook(__FILE__, 'tournament_scheduler_activate');
register_deactivation_hook(__FILE__, 'tournament_scheduler_deactivate');
add_action( 'plugins_loaded', 'tournament_scheduler_activate' );

function tournament_scheduler_activate() {
	require_once dirname(__FILE__).'/tournament_scheduler_loader.php';
	$loader = new TournamentSchedulerLoader();
	$loader->activate();
}

function tournament_scheduler_deactivate() {
	require_once dirname(__FILE__).'/tournament_scheduler_loader.php';
	$loader = new TournamentSchedulerLoader();
	$loader->deactivate();
}

?>