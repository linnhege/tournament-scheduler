<td><?php echo (date("j F Y", strtotime($tournament->date))); ?></td>
<td>
	<?php echo $this->html->tournament_link($tournament); ?>
</td>