<h2><?php echo $object->__name; ?></h2>
<br>
<?php
if (empty($seedingList)) {
    echo "<p>Ingen rankingpoeng delt ut</p>";
} else {
    echo "<table>";
    echo "<thead><tr><td>Spiller</td><td>Poeng</td></tr></thead><tbody>";
    foreach ($seedingList as $seeding):
    echo "<tr><td>". $seeding->player->display_name ."</td><td>". $seeding->points ."</td></tr>";
    endforeach;
    echo "</tbody></table>";
}
?>
<p>
    <?php echo $this->html->link('&#8592; Se alle Rankingklasser', array('controller' => 'series')); ?>
</p>