<h2><?php echo $tournament->__name; ?></h2>
<?php
$this->display_flash();

$this->render_view("_details", array('locals' => array('tournament' => $tournament)));

$this->render_view("_signup", array('locals' =>
    array('tournament' => $tournament,
        'current_user' => $current_user,
        'adminUrl' => $adminUrl,
        'availablePlayers' => $availablePlayers,
        'isUserSignedup' =>  $isUserSignedup)));


$this->render_view("_signup_teams",
    array( 'locals' =>
        array(
            'seedingList' => $seedingList
        )));


$this->render_view("_tournament_result",
    array( 'locals' =>
    array(
        'results' => $results
    )));


?>
<p>
    <?php echo $this->html->link('&#8592; All Tournaments', array('controller' => 'tournaments')); ?>
</p>
