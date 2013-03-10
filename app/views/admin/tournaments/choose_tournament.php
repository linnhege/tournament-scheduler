<?php
if(empty($tournaments)):
    echo "<p>Ingen turneringer eksistere</p>";
else:
    echo "<h2>Choose tournament to edit</h2>";
    echo "<ul>";
foreach($tournaments as $tournament):
     echo "<li>" . display_tournament_result($tournament) . "</li>";
endforeach;
    echo "</ul>";
endif;