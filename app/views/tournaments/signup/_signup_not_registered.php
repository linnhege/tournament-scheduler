<?php
$html = "<p>";
$html .= "<form method='post' action='/wordpress/tournaments/add_team/{$tournament->id}'>";
$html .= MvcFormTagsHelper::hidden_input('tournament_id', array('value' => $tournament->id));
$html .= MvcFormTagsHelper::hidden_input('player_id1', array('value' => $current_user->ID));
$html .= "{$current_user->display_name} - ";
$html .= MvcFormTagsHelper::select_input('player_id2', array('options' => $availablePlayers));
$html .= '<input type="submit" />';
$html .= '</form>';
$html .= "</p>";
echo $html;
?>
