<?php
echo "<div id='resultlist'>";
echo "<h3 id='resultlist_header'>Resultatliste</h3>";
if (empty($results)):
    echo "<p id='resultlist_message'>Ingen plasseringer er utdelt</p>";
else:
    echo "<ul>";
    foreach($results as $result):
        $place = $result->place;
        $points = $result->points;
        echo "<li>$place. ". display_team($result->team) . " (points: $points) </li>";
    endforeach;
    echo "</ul>";
endif;
echo "<div>";

