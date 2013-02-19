<h2>Players</h2>
<?php
if (empty($users)):
    echo "ingen spillere registert";
else:
    echo "<ul>";
    foreach ($users as $user):
        echo "<ul>". display_tournament_user($user) . "</ul>";
    endforeach;
    echo "</ul>";
endif;
?>
