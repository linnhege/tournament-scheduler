<div id="single-tournament">
    <div class="post-heading">
        <h1><?php echo $tournament->__name; ?></h1>
        <span class="timeAndPlace">
            <?php echo date("j F Y", strtotime($tournament->date)); ?> - <?php echo $tournament->location_name; ?>
        </span>

        <div class="admin">
            <?php
            if(current_user_can( 'delete_others_pages' )):
                $url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $tournament->__id));
                echo '<a href="'.$url.'">Admin</a>';
            endif;
            ?>
        </div>
    </div>

    <?php
        echo "<div class='flash'>";
        $this->display_flash();
        echo "</div>";
    ?>


    <div class="block half">
        <?php $this->render_view("_details", array('locals' => array('tournament' => $tournament))); ?>
    </div>
    <div class="block half last">
        <?php
            $this->render_view("_signup", array('locals' =>
            array('tournament' => $tournament,
                'current_user' => $current_user,
                'adminUrl' => $adminUrl,
                'availablePlayers' => $availablePlayers,
                'isUserSignedup' =>  $isUserSignedup,
                'canUserSignup' => $canUserSignup,
                'seedingList' => $seedingList)
            ));
        ?>
    </div>
    <div style="clear: both;"></div>
    <div class="block full">
        <?php
            $this->render_view("_signup_teams",
            array('locals' =>
            array(
            'seedingList' => $seedingList
            )));
        ?>
    </div>
    <div class="block full">
        <?php
        $this->render_view("_tournament_result",
            array('locals' =>
            array(
                'results' => $results
            )));
        ?>
    </div>
</div>