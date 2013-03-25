<?php

echo "<h3> Add Team </h3>";

$baseUrl = get_bloginfo('url');

$html = "<p>";
$html .= "<form method='post' action='".$baseUrl."/tournaments/add_team/{$tournament->id}'>";
$html .= MvcFormTagsHelper::hidden_input('tournament_id', array('value' => $tournament->id));
$html .= MvcFormTagsHelper::select_input('player_id1', array('options' => $availablePlayers));
$html .= " - ";
$html .= MvcFormTagsHelper::select_input('player_id2', array('options' => $availablePlayers));
$html .= '<input type="submit" />';
$html .= '</form>';
$html .= "</p>";
echo $html;

