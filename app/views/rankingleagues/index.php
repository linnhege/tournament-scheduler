<h2>Rankingleagues</h2>

<?php foreach ($objects as $user): ?>

	<?php $this->render_view('_item', array('locals' => array('object' => $user))); ?>

<?php endforeach; ?>

<?php echo $this->pagination(); ?>