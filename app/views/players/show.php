<h2><?php echo $player->user->display_name; ?></h2>
<div class="details">
    <ul>
        <li>Navn: <?php echo $player->user->display_name ?> </li>
        <li>Ranking: <?php echo $player->getRanking() ?> </li>
    </ul>
</div>
<div class="results">
    <?php
    $results = $player->results();
    if(empty($results)):
        echo "<p>Ingen Resultater registert</p>";
    else:
        foreach($results as $result):
            echo "<ul>";
            echo "<li>" .$result->place  . "</li>";
            echo "</ul>";
        endforeach;
    endif;
    ?>
</div>
<p>
	<?php echo $this->html->link('&#8592; All Players', array('controller' => 'players')); ?>
</p>