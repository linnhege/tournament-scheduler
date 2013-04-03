<?php
echo "<h2>" . $tournament->name . "</h2>";

if (empty($results)) {
    echo "<p>Ingen lag er registert til denne turneringen</p>";
} else {
    echo "<h3>Results</h3>";
    echo "<form method='POST' action='" . $form_url . "'>";
    $numberOfTeamsSignedUp = count($results);
    foreach ($results as $result):
        echo "<p>place | points | team</p>";
        echo '<input name="id[]" type="hidden" value="' . $result->id . '">';
        echo '<select name="place[]">';
        for ($i = 1; $i <= $numberOfTeamsSignedUp; $i++):
            echo '<option>' . $i . '</option>';
        endfor;
        echo '</select>';
        echo '<input name="points[]" value="' . $result->points . '">';
        echo display_team($result->team);
        echo '<span class="delete-result"> <a href=' . get_admin_url() . 'admin.php/?page=mvc_results-delete&id=' . $result->id . '&tournament=' . $tournament->id . '>Remove</a></span>';
        echo 'Meldt på av ';
        $signedUpUser = get_user_by('id', $result->signedUpBy);
        echo '<span class="signedUpBy">'.$signedUpUser->display_name.'</span> ';
        echo 'den <span class="signedUpDate">'.$result->signedUpDate.'</span>';
    endforeach;
    echo "<br/> <input type='submit'>";
    echo "</form>";
}

$this->render_view('admin/results/_signup_teams', array('locals' =>
array('tournament' => $tournament,
    'availablePlayers' => $availablePlayers)));







