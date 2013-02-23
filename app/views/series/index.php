<h2>Rankingklasse</h2>

<ul>
<?php foreach ($objects as $object): ?>
    <li>
	<?php $this->render_view('_item', array('locals' => array('object' => $object))); ?>
    </li>
<?php endforeach; ?>
</ul>
<?php echo $this->pagination(); ?>