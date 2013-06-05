<h3>Påmeldte lag <span class="arrows">»</span></h3>
<?php
$site_url = site_url();

if(empty($seedingList)) {
    echo "<p>Ingen påmeldte lag</p>";
} else {
    echo "<ul>";
    $i = 1;
    foreach($seedingList as $team):
        echo "<li>";
        echo "$i. " . display_team_with_seeding($team);
        echo "</li>";
        $i++;
    endforeach;
    echo "</ul>";
}
