<h2>Add Tournament</h2>

<?php echo $this->form->create($model->name); ?>
<?php echo $this->form->input('name'); ?>
<?php echo $this->form->belongs_to_dropdown('Serie', $series, array('style' => 'width: 200px;', 'empty' => true)); ?>
<?php echo $this->form->input('date', array('label' => 'Date (YYYY-MM-DD)')); ?>
<?php echo $this->form->input('location'); ?>
<?php echo $this->form->input('price'); ?>
<?php echo $this->form->input('turneringsansvarlig'); ?>
<?php echo $this->form->input('maximum_teams'); ?>
<?php echo $this->form->input('details'); ?>
<?php echo $this->form->end('Add'); ?>