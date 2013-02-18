<h3>Påmeldte lag:</h3>
<?php
$site_url = site_url();

if(empty($seedingList)) {
    echo "Ingen påmeldte lag";
} else {
    echo "<ul>";
    foreach($seedingList as $team):
        $user1 = $team->getUser1();
        $user2 = $team->getUser2();
        $ranking = $team->getRanking();
        echo "<li>1.
                    <a href='${site_url}/players/{$user1->ID}'>{$user1->user_nicename}</a> -
                    <a href='${site_url}/players/{$user2->ID}'>{$user2->user_nicename}</a> (${ranking})
            </li>";
    endforeach;
    echo "</ul>";
}
