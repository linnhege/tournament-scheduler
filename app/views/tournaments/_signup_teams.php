<h3>Påmeldte lag:</h3>
<?php

if($seeding == null) {
    echo "Ingen påmeldte lag";
} else {
    echo "<ul>";
    foreach($seeding as $team):
        $players = $team->get();
        echo "<li>1. <a href='tournament-events/'>{$players[0]}</a> - <a href='#see_player_info'>{$players[1]}</a></li>";
    endforeach;
    echo "</ul>";
}
