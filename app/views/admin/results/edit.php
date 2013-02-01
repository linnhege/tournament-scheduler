<h2>Edit Result</h2>

<?php echo $this->form->create($model->name); ?>
<?php echo $this->form->belongs_to_dropdown('Teams', $tournaments, array('style' => 'width: 200px;', 'empty' => true)); ?>
<?php echo $this->form->belongs_to_dropdown('Tournament', $teams, array('style' => 'width: 200px;', 'empty' => true)); ?>
<?php echo $this->form->input('points'); ?>
<?php echo $this->form->input('place'); ?>
<?php echo $this->form->input('comment'); ?>
<?php echo $this->form->end('Update'); ?>