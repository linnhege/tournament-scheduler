<h2>Matches</h2>

<?php foreach ($objects as $tournament): ?>

	<?php $this->render_view('_item', array('locals' => array('object' => $tournament))); ?>

<?php endforeach; ?>

<?php echo $this->pagination(); ?>