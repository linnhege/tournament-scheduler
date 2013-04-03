<div id="admin">
    <?php
    if(current_user_can( 'delete_others_pages' )):
        $url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $tournament->__id));
        echo '<a href="'.$url.'">Admin</a>';
    endif;
    ?>
</div>
<div id="tournament">

<h1><?php echo $tournament->__name; ?></h1>
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
            'isUserSignedup' =>  $isUserSignedup,
            'canUserSignup' => $canUserSignup)
    ));
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

</div>
