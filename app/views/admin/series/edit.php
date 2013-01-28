<h2>Edit Series</h2>

<?php echo $this->form->create($model->name); ?>
<?php echo $this->form->input('name'); ?>
<?php echo $this->form->belongs_to_dropdown('Rankingleague', $rankingleagues, array('style' => 'width: 200px;', 'empty' => true)); ?>
<?php echo $this->form->end('Update'); ?>