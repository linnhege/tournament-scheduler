<h2><?php echo $object->__name; ?></h2>
<?
//function viewTournamentDetails($object, $seeding, $available_players, $userAlreadySignup, $result = null)


$current_user = wp_get_current_user();

if ($userAlreadySignup) {
$signupHtml = "Du er allerede meldt pÃ¥.";
} elseif ( $current_user->ID == 0  ) {
$signupHtml = "<p><strong><a href='". wp_login_url(get_permalink()) ."'> Logg inn </a> for og melde deg pÃ¥ turneringen</strong></p>
<p>Alle medlemmer av OSVB har en konto, vet du ikke ditt brukernavn og passord, prÃ¸v og trykk pÃ¥ logg inn ogsÃ¥ velg 'Lost your password?', og skriv inn din mailaddresse</p>
<p>Er du ikke medlemm av OSVB, trykk logg inn ogsÃ¥ login inn via facebook, du blir medlemm av OSVB under registeringsprossesen :)";
    } else {
    $signupHtml = signupForm($current_user->ID, $current_user->data->display_name, $available_players, $object);
    }

echo    "
<h3>Details</h3>
<div><ul class='admin'>
    <li id='name'>
        <span class='property'>Name:</span>
        <span class='value'>{$object->name}</span>
    </li>
    <li id='place'>
        <span class='property'>Location:</span>
        <span class='value'>{$object->location}</span>
    </li>
    <li id='place'>
        <span class='property'>date:</span>
        <span class='value'>{$object->date}</span>
    </li>
</ul></div>

<h3>Meld på lag:</h3>
$signupHtml


<h3>Påmeldte lag:</h3>";
if($seeding == null) {
echo "Ingen pÃ¥meldte lag";
} else {
    echo "<ul>";
    foreach($seeding as $team):
    $players = $team->get();

    echo "<li>1. <a href='tournament-events/'>{$players[0]}</a> - <a href='#see_player_info'>{$players[1]}</a></li>";
    endforeach;
    echo "</ul>";
}

echo "<h3>Resultatliste</h3>";
if (!$result) {
    echo "Ingen plasseringer er utdelt";
}

echo "<h3>Kampresultater</h3>";
?>
<p>
	<?php echo $this->html->link('&#8592; All Tournaments', array('controller' => 'tournaments')); ?>
</p>
