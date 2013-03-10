<?php
    echo "<h2>" . $tournament->name . "</h2>";
    echo "<h3>Results</h3>";

echo "<form method='POST' action='". $form_url ."'>";

foreach($results as $result):
    echo "<p>place | points | team</p>";
    echo '<input name="id[]" type="hidden" value="' . $result->id . '">';
    echo '<input name="place[]" value="' . $result->place . '">';
    echo '<input name="points[]" value="' . $result->points . '">';
    echo display_team($result->team);

endforeach;

echo "<br/> <input type='submit'>";
echo "</form>";


