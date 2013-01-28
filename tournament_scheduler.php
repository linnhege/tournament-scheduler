<?php
/*
Plugin Name: Tournament Scheduler
Plugin URI: 
Description: 
Author: 
Version: 
Author URI: 
*/

register_activation_hook(__FILE__, 'tournament_scheduler_activate');
register_deactivation_hook(__FILE__, 'tournament_scheduler_deactivate');

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