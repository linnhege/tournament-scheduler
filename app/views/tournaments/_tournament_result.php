<?php
echo "<div id='resultlist'>";
echo "<h3 id='resultlist_header'>Resultatliste  <span class='arrows'> >> </span></h3>";
if (empty($results)):
    echo "<p id='resultlist_message'>Ingen plasseringer er utdelt</p>";
else:
    echo "<ul>";
    foreach($results as $result):
        $place = $result->place;
        echo "<li>$place. ". display_team($result->team) . "</li>";
    endforeach;
    echo "</ul>";
endif;
echo "<div>";

