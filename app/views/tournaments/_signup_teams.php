<h3>Påmeldte lag:</h3>
<?php
$site_url = site_url();

if(empty($seedingList)) {
    echo "Ingen påmeldte lag";
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
