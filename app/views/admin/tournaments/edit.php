<h2>Edit Tournament</h2>
<h3>Details</h3>
<?php echo $this->form->create($model->name); ?>
<?php echo $this->form->input('name'); ?>
<?php echo $this->form->belongs_to_dropdown('Series', $series, array('style' => 'width: 200px;')); ?>
<?php echo $this->form->input('date', array('label' => 'Date (YYYY-MM-DD)')); ?>
<?php echo $this->form->input('price'); ?>
<?php echo $this->form->belongs_to_dropdown('Location', $locations, array('style' => 'width: 200px;', 'empty' => true)); ?>
<?php echo $this->form->belongs_to_dropdown('TournamentResponsible', $tournamentResponsible, array('style' => 'width: 200px;', 'empty' => true)); ?>
<?php echo $this->form->input('maximum_teams'); ?>
<?php echo $this->form->input('details'); ?>
<?php echo $this->form->end('Update'); ?>

<h3>Results / Teams </h3>
<?php
$url = MvcRouter::admin_url(array('controller' => 'results', 'action' => 'edit_result', 'id' => $object->__id));
echo '<a href="'.$url.'">Edit Results</a>';
?>

<h3>Matches</h3>
<p>Not yet possible</p>

