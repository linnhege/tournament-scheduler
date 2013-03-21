<h2><?php echo $player->user->display_name; ?></h2>
<div class="details">
    <ul>
        <li>Navn: <?php echo $player->user->display_name ?> </li>
        <?php
        $rankings = $player->getRankingforAllRankingLeagues();
        if(!empty($rankings)):
            echo "<table><thead><tr><td>Rankingleague</td><td>Poeng</td></tr></thead><tbody>";
            foreach($rankings as $ranking):
                echo "<tr><td>".$ranking->name."</td><td>".$ranking->points."</td></tr>";
            endforeach;
            echo "</tbody></table>";
        endif;
?>

</div>
<div class="results">
    <?php
    $results = $player->results();
    if(empty($results)):
        echo "<p>Ingen Resultater registert</p>";
    else:
        foreach($results as $ranking):
            echo "<ul>";
            echo "<li>" .$ranking->place  . "</li>";
            echo "</ul>";
        endforeach;
    endif;
    ?>
</div>
<p>
	<?php echo $this->html->link('&#8592; All Players', array('controller' => 'players')); ?>
</p>