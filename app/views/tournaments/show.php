<div id="tournament">

<h2><?php echo $tournament->__name; ?></h2>
<?php
echo "<div class='flash'>";
    $this->display_flash();
echo "</div>";

echo "<div id='details'>";
    $this->render_view("_details", array('locals' => array('tournament' => $tournament)));
echo "<div>";

echo "<div id='signup'>";
    $this->render_view("_signup", array('locals' =>
        array('tournament' => $tournament,
            'current_user' => $current_user,
            'adminUrl' => $adminUrl,
            'availablePlayers' => $availablePlayers,
            'isUserSignedup' =>  $isUserSignedup)));
echo "<div>";

echo "<div id='signup_teams'>";
    $this->render_view("_signup_teams",
        array('locals' =>
        array(
            'seedingList' => $seedingList
        )));
    echo "<div>";


    echo "<div id='tournament_result'>";
    $this->render_view("_tournament_result",
        array('locals' =>
        array(
            'results' => $results
        )));
    echo "<div>";

    ?>
    <p>
        <?php echo $this->html->link('&#8592; All Tournaments', array('controller' => 'tournaments')); ?>
    </p>

</div>
